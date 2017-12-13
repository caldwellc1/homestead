<?php

namespace Homestead;

class AssignmentGroupListView extends View {

    public function show() {

        $tpl = array();
        $tpl['vendor_bundle'] = AssetResolver::resolveJsPath('assets.json', 'vendor');
        $tpl['entry_bundle'] = AssetResolver::resolveJsPath('assets.json', 'groupAssignList');

        return \PHPWS_Template::process($tpl, 'hms', 'admin/groupAssignList.tpl');
    }
}
