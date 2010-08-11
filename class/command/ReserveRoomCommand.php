<?php

PHPWS_Core::initModClass('hms', 'Command.php');
PHPWS_Core::initModClass('hms', 'CommandContext.php');
PHPWS_Core::initModClass('hms', 'HMS_Bed.php');

class ReserveRoomCommand extends Command {

    public function getRequestVars(){
        $vars = array('action'=>'ReserveRoom');
    }

    public function execute(CommandContext $context){
        $bed = $context->get('bed');
        $bed = new HMS_Bed($bed);
        $bed->loadAssignment();

        if($bed->_curr_assignment instanceof HMS_Assignment || is_null($context->get('clear')) && $bed->room_change_reserved != 0) {
            test(is_null($context->get('clear')));
            test($bed->_curr_assignment != 0);
            test('wtf?',1);
            NQ::simple('hms', HMS_NOTIFICATION_ERROR, 'That bed is unavailable!');
            $cmd = CommandFactory::getCommand($context->get('last_command'));
            return $cmd;
        }

        if(is_null($bed->_curr_assignment)){
            $status = is_null($context->get('clear')) ? 1 : 0;
            $bed->room_change_reserved = $status;
            $bed->save();

            if($staus == 1){
                NQ::simple('hms', HMS_NOTIFICATION_SUCCESS, 'The bed has been reserved!');
            }
        }
    }
}

?>