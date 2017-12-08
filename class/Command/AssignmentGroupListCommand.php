<?php

namespace Homestead\Command;

use \Homestead\AssignmentGroupListView;

/**
 * @author Cydney Caldwell
 */

class AssignmentGroupListCommand extends Command {

    public function getRequestVars()
    {
        return array('action'=>'AssigmentGroupList');
    }

    public function execute(CommandContext $context)
    {
        //check students are accepted into the RLC
        //return error message to groupassign page else go to show assignments page
        $groupListView = new AssignmentGroupListView();
        $context->setContent($groupListView->show());
    }
}
