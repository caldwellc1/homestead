<?php

namespace Homestead\Command;

use Homestead\Term;
use Homestead\RlcFactory;

class GetRlcListCommand extends Command {

    public function getRequestVars(){
        return array('action'=>'GetRlcList');
    }

    public function execute(CommandContext $context)
    {
        $rlcs = RlcFactory::getRlcList(Term::getSelectedTerm());

        echo json_encode($rlcs);
        exit;
    }
}
