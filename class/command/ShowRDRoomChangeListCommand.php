<?php

PHPWS_Core::initModClass('hms', 'RoomChangeRequestFactory.php');
PHPWS_Core::initModClass('hms', 'RoomChangeApprovalView.php');
PHPWS_Core::initModClass('hms', 'HMS_Permission.php');

PHPWS_Core::initModClass('hms', 'HMS_Residence_Hall.php');
PHPWS_Core::initModClass('hms', 'HMS_Floor.php');

class ShowRDRoomChangeListCommand extends Command {

    public function getRequestVars(){
        return array('action'=>'ShowRDRoomChangeList');
    }

    public function execute(CommandContext $context){

        $term = Term::getCurrentTerm();

        // Get the list of role memberships this user has
        $memberships = HMS_Permission::getMembership('room_change_approve', NULL, UserStatus::getUsername());

        if(empty($memberships)){
            PHPWS_Core::initModClass('hms', 'exception/PermissionException.php');
            throw new PermissionException("Your account does not have the 'RD' role on any residence halls or floors.");
        }

        // Use the roles to instantiate a list of floors this user has access to
        $floors = array();

        foreach ($memberships as $member) {
            if ($member['class'] == 'hms_residence_hall') {
                $hall = new HMS_Residence_Hall($member['instance']);
                $floors = array_merge($floors, $hall->getFloors());
            } else if ($member['class'] == 'hms_floor') {
                $floors[] = new HMS_Floor($member['instance']);
            } else {
                throw new Exception('Unknown object type.');
            }
        }


        // Remove duplicate floors
        $uniqueFloors = array();
        foreach($floors as $floor){
            $uniqueFloors[$floor->getId()] = $floor;
        }

        // Use the list of floors to get a unique list of hall names
        $hallNames = array();
        foreach($uniqueFloors as $floor){
            $hall = $floor->get_parent();
            $hallNames[$hall->getId()] = $hall->getHallName();
        }

        // Get the set of room changes which are not complete based on the floor list
        $roomChanges = RoomChangeRequestFactory::getRoomChangesByFloorList($term, $uniqueFloors, array('Pending'));

        $view = new RoomChangeApprovalView($roomChanges, $hallNames, $term);

        $context->setContent($view->show());
    }
}
?>