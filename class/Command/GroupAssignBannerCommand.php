<?php

namespace Homestead\Command;

use \Homestead\GroupAssignBannerView;
use \Homestead\Exception\PermissionException;

/**
 * @author Cydney Caldwell
 */

class GroupAssignBannerCommand extends Command {

    public function getRequestVars()
    {
        return array('action'=>'GroupAssignBanner');
    }

    public function execute(CommandContext $context)
    {
        if (!\Current_User::allow('hms', 'group_assign')) {
            throw new PermissionException('You do not have permission to group assign students.');
        }
        $groupView = new GroupAssignBannerView();
        $context->setContent($groupView->show());
    }
}
