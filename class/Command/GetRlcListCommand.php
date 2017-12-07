<?php

namespace Homestead\Command;

use Homestead\PdoFactory;

class GetRlcListCommand extends Command {

    public function getRequestVars(){
        return array('action'=>'GetRlcList');
    }

    public function execute(CommandContext $context)
    {
        $pdo = PdoFactory::getPdoInstance();
        $prep = $pdo->prepare("select id, community_name as title from hms_learning_communities order by community_name");
        $prep->execute();
        $rlc = $prep->fetchAll(\PDO::FETCH_ASSOC);
        $context->setContent(json_encode($rlc));
    }
}
