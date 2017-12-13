<?php

namespace Homestead\Command;

use \Homestead\AssignmentGroupListView;
use \Homestead\PdoFactory;
use \Homestead\Term;

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
        $reason = $_POST['reason'];
        if (isset($_POST['hallName'])){
            $hallName = $_POST['hallName'];
        }
        if (isset($_POST['floorName'])){
            $floorName = $_POST['floorName'];
        }
        if (isset($_POST['groupName'])){
            $groupName = $_POST['groupName'];
        }
        $term = Term::getCurrentTerm();
        //have to get students so we know what gender they are
        //if only group selected the look at beds reserved for group
        //if hall selected then get all beds for that hall
        //if floor selected get all beds for that floor
        $db = PdoFactory::getPdoInstance();
        $sql = "SELECT * FROM hms_bed
           LEFT JOIN hms_room
           ON hms_bed.room_id = hms_room.id
           LEFT JOIN hms_floor
           ON hms_room.floor_id = hms_floor.id
           LEFT JOIN hms_residence_hall
           ON hms_floor.residence_hall_id = hms_residence_hall.id
           LEFT JOIN hms_learning_communities
           ON hms_floor.rlc_id = hms_learning_communities.id
           WHERE hms_bed.term = :term AND hms_floor.floor_number = :floorName AND hms_residence_hall.hall_name = :hall
           AND hms_room.offline = 0 AND hms_floor.is_online = 1 AND hms_residence_hall.is_online = 1
           AND hms_room.reserved = 0 AND hms_room.ra = 0 AND hms_room.overflow = 0 AND hms_room.private = 0 AND hms_learning_communities.community_name = :rlc";
           $sth = $db->prepare($sql);
           $sth->execute(array('term' => $term, 'floorName' => $floorName, 'hall' => $hallName, 'rlc' => $groupName));
           $result = $sth->fetch(\PDO::FETCH_COLUMN);
        var_dump($result);
        //check students are accepted into the RLC
        //return error message to groupassign page else go to show assignments page
        //$groupListView = new AssignmentGroupListView();
        //$context->setContent($groupListView->show());
    }
}
