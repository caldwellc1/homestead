<?php

namespace Homestead\Command;

use \Homestead\HMS_Activity_Log;
use \Homestead\HMS_RLC_Application;
use \Homestead\NotificationView;
use \Homestead\Exception\PermissionException;

class DenyRlcApplicationCommand extends Command {

    private $applicationId;

    public function setApplicationId($id){
        $this->applicationId = $id;
    }

    public function getRequestVars(){
        return array('action'=>'DenyRlcApplication', 'applicationId'=>$this->applicationId);
    }

    public function execute(CommandContext $context)
    {
        if(!\Current_User::allow('hms', 'approve_rlc_applications')){
            throw new PermissionException('You do not have permission to approve/deny RLC applications.');
        }

        $app = HMS_RLC_Application::getApplicationById($context->get('applicationId'));
        $app->denied = 1;
        $app->save();

        $student = StudentFactory::getStudentByUsername($app->username, $app->getTerm());
        $activityLog = new HMS_Activity_Log($app->username, time(), 'ACTIVITY_DENIED_RLC_APPLICATION', \Current_User::getUsername(), 'Application Denied', $student->getBannerId());
        $activityLog->save();

        \NQ::simple('hms', NotificationView::SUCCESS, 'Application denied.');

        $context->goBack();
    }
}
