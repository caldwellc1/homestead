<?php

namespace Homestead\Command;

use \Homestead\GroupAssignView;

/**
 * @author Cydney Caldwell
 */

class GroupAssignCommand extends Command {

    public function getRequestVars()
    {
        return array('action'=>'GroupAssign');
    }

    public function execute(CommandContext $context)
    {
        $groupView = new GroupAssignView();
        $context->setContent($groupView->show());
    }
}
