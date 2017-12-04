<?php

namespace Homestead;

class GroupAssignView extends View {

    public function show() {

        $tpl = array();
        $tpl['vendor_bundle'] = AssetResolver::resolveJsPath('assets.json', 'vendor');
        $tpl['entry_bundle'] = AssetResolver::resolveJsPath('assets.json', 'groupAssign');

        return \PHPWS_Template::process($tpl, 'hms', 'admin/groupAssign.tpl');
    }
}
