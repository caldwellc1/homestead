<?php

class AjaxSetRlcAssignmentStatusCommand extends Command{

    public function setAssignmentId($id){
        $this->assignmentId = $id;
    }

    public function getRequestVars(){
        return array('action'=>'RemoveRlcAssignment', 'assignmentId'=>$this->assignmentId);
    }

    public function execute(CommandContext $context)
    {
        if(!Current_User::allow('hms', 'add_rlc_members')){
            PHPWS_Core::initModClass('hms', 'exception/PermissionException.php');
            throw new PermissionException('You do not have permission to change Rlc Assignments.');
        }

        $newState = $_REQUEST['status'];
        $id = $_REQUEST['assignmentId'];

        PHPWS_Core::initModClass('hms', 'HMS_RLC_Assignment.php');

        $assignment = HMS_RLC_Assignment::getAssignmentById($context->get('assignmentId'));

        $assignment->setState($newState);

        $assignment->save();

        echo json_encode(array("message" => "Assignment status updated", "type" => "success"));
        exit;
    }
}
