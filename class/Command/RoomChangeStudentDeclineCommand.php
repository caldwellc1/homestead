<?php

namespace Homestead\Command;

use \Homestead\RoomChangeRequestFactory;
use \Homestead\RoomChangeParticipantFactory;
use \Homestead\RoomChangeStateCancelled;
use \Homestead\ParticipantStateCancelled;
use \Homestead\StudentFactory;
use \Homestead\CommandFactory;
use \Homestead\NotificationView;
use \Homestead\UserStatus;
use \Homestead\HMS_Activity_Log;
use \Homestead\Exception\PermissionException;

class RoomChangeStudentDeclineCommand extends Command {

    private $requestId;
    private $participantId;

    public function setRequestId($id)
    {
        $this->requestId = $id;
    }

    public function setParticipantId($id)
    {
        $this->participantId = $id;
    }

    public function getRequestVars()
    {
        return array('action'           => 'RoomChangeStudentDecline',
                     'requestId'        => $this->requestId,
                     'participantId'    => $this->participantId);
    }

    public function execute(CommandContext $context)
    {
        // Get input
        $requestId = $context->get('requestId');
        $participantId = $context->get('participantId');

        // Load the request
        $request = RoomChangeRequestFactory::getRequestById($requestId);

        // Load the participant
        $participant = RoomChangeParticipantFactory::getParticipantById($participantId);

        // Load the Student
        $student = StudentFactory::getStudentByBannerId($participant->getBannerId(), $request->getTerm());

        // Check permissions. Must be the participant or an admin
        if(UserStatus::getUsername() != $student->getUsername()
            && !\Current_User::allow('hms', 'admin_approve_room_change')) {
            throw new PermissionException('You do not have permission to decline this room change.');
        }

        // Check for CAPTCHA if this is the student; admins don't need a CAPTCHA
        $captchaResult = \Captcha::verify(true);
        if ($captchaResult === false) {
            // Failed the captcha
            \NQ::simple('hms', NotificationView::ERROR, "You didn't type the magic words correctly. Please try again.");
            $cmd = CommandFactory::getCommand('ShowRoomChangeRequestApproval');
            $cmd->redirect();
        }


        $activityLog = new HMS_Activity_Log(UserStatus::getUsername(), time(), 'ACTIVITY_ROOM_CHANGE_DECLINE', UserStatus::getUsername(FALSE), 'Request id: ' . $requestId . ' Captcha: ' . $captchaResult, $student->getBannerId());
        $activityLog->save();

        // Transition request to cancelled status
        $request->transitionTo(new RoomChangeStateCancelled($request, time(), null, UserStatus::getUsername()));

        // Transition all participants to cancelled
        // TODO... Do this in the cancelled transition?
        $participants = $request->getParticipants();

        foreach ($participants as $p) {
            $p->transitionTo(new ParticipantStateCancelled($p, time(), null, UserStatus::getUsername()));
        }

        // TODO Notify everyone that the request was cancelled

        \NQ::simple('hms', NotificationView::SUCCESS, 'You have declined the room change request.');
        $menuCmd = CommandFactory::getCommand('ShowStudentMenu');
        $menuCmd->redirect();
    }
}
