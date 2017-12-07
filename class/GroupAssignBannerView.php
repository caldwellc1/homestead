<?php

namespace Homestead;

class GroupAssignBannerView extends View {

    public function show() {

        $submitCmd = CommandFactory::getCommand('GroupAssignSetBanner');

        $form = new \PHPWS_Form('magic_form');
        $submitCmd->initForm($form);

        $form->addTextArea('banner_ids');

        $form->addSubmit('Submit');

        \Layout::addPageTitle("Group Assign Banner Entry");

        return \PHPWS_Template::process($form->getTemplate(), 'hms', 'admin/GroupAssignBanner.tpl');
    }
}
