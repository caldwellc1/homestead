<?php

namespace Homestead\Command;

use \Homestead\ActivityLogRestored;

class AjaxActivityLogCommand extends Command {

    public function getRequestVars(){
        return array('action'=>'AjaxActivityLog');
    }

    public function execute(CommandContext $context)
    {
        $activity = new ActivityLogRestored();
        $activities = $activity->getAllLogs();
        $context->setContent(json_encode($activities));
    }
}
