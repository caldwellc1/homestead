<?php

PHPWS_Core::initModClass('hms', 'Command.php');
PHPWS_Core::initModClass('hms', 'RoomChangeRequest.php');
PHPWS_Core::initModClass('hms', 'HMS_Permission.php');
PHPWS_Core::initModClass('hms', 'HMS_Residence_Hall.php');

class RDSubmitUpdateCommand extends Command {

    public function getRequestVars(){
        return array('action'=>'RDSubmitUpdate');
    }

    public function execute(CommandContext $context){
        $rc = new RoomChangeRequest;
        $rc = $rc->search($context->get('username'));
        $rc->load();

        $hall = new HMS_Residence_Hall;
        $hall->id = $rc->curr_hall;
        $hall->load();

        $memberships = HMS_Permission::getMembership('room_change_approve', $hall, UserStatus::getUsername());

        if(empty($memberships)){
            throw new PermissionException("You can't do that");
        }

        if(is_null($context->get('approve_deny'))){
            NQ::simple('hms', HMS_NOTIFICATION_ERROR, 'You must either approve or deny the request!');
        }

        $approve = $context->get('approve_deny') == 'approve' ? true : false;

        if($approve){
            if($rc->is_swap){
                $rc->change(new WaitingForPairing);
            } else { //preserving existing logic for now TODO: un-nest this crud
                $bed = $context->get('bed');
                if(is_null($bed)){
                    NQ::simple('hms', HMS_NOTIFICATION_ERROR, 'You must select a bed!');
                    $cmd = CommandFactory::getCommand('RDRoomChange');
                    $cmd->username = $context->get('username');
                    $cmd->redirect();
                }

                $rc->requested_bed_id = $bed;
                $rc->change(new RDApprovedChangeRequest);
            }
        } else {
            $rc->denied_reason = $context->get('reason');
            $rc->change(new DeniedChangeRequest);
            $rc->save();
            $cmd = CommandFactory::getCommand('RDRoomChange');
            $cmd->redirect();
        }

        //okay, it worked, save the state change
        $rc->save();

        $cmd = CommandFactory::getCommand('RDRoomChange');
        $cmd->redirect();
    }
}
?>