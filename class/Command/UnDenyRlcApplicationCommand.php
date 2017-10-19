<?php

namespace Homestead\Command;

use \Homestead\HMS_RLC_Application;
use \Homestead\HMS_Activity_Log;
use \Homestead\CommandFactory;
use \Homestead\NotificationView;
use \Homestead\UserStatus;
use \Homestead\Exception\PermissionException;

class UnDenyRlcApplicationCommand extends Command {

    private $applicationId;

    public function setApplicationId($id){
        $this->applicationId = $id;
    }

    public function getRequestVars(){
        return array('action'=>'UnDenyRlcApplication', 'applicationId'=>$this->applicationId);
    }

    public function execute(CommandContext $context)
    {
        if(!\Current_User::allow('hms', 'approve_rlc_applications')){
            throw new PermissionException('You do not have permission to approve/deny RLC applications.');
        }

        $app = HMS_RLC_Application::getApplicationById($context->get('applicationId'));
        $app->denied = 0;
        $app->save();

        $activityLog = new HMS_Activity_Log($app->username, time(), 'ACTIVITY_UNDENIED_RLC_APPLICATION', UserStatus::getUsername(), "Application un-denied", $banner);
        $activityLog->save();

        \NQ::simple('hms', NotificationView::SUCCESS, 'Application un-denied.');

        $successCmd = CommandFactory::getCommand('ShowDeniedRlcApplicants');
        $successCmd->redirect();
    }
}
