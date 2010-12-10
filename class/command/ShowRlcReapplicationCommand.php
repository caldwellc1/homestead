<?php

class ShowRlcReapplicationCommand extends Command {

    private $term;

    public function setTerm($term){
        $this->term = $term;
    }

    public function getRequestVars(){
        return array('action'=>'ShowRlcReapplication', 'term'=>$this->term);
    }

    public function execute(CommandContext $context){

        PHPWS_Core::initModClass('hms', 'HousingApplication.php');
        PHPWS_Core::initModClass('hms', 'StudentFactory.php');
        PHPWS_Core::initModClass('hms', 'RlcReapplicationView.php');
        PHPWS_Core::initModClass('hms', 'HMS_RLC_Assignment.php');

        $errorCmd = CommandFactory::getCommand('ShowStudentMenu');

        $term = $context->get('term');
        $student = StudentFactory::getStudentByUsername(UserStatus::getUsername(), $term);

        # Double check the the student is eligible
        $housingApp = HousingApplication::getApplicationByUser($student->getUsername(), $term);
        if(!$housingApp instanceof LotteryApplication){
            NQ::simple('hms', HMS_NOTIFICATION_ERROR, 'You are not eligible to re-apply for a Learning Community.');
            $errorCmd->redirect();
        }

        # Look up any existing RLC assignment (for the current term, should be the Spring term)
        $rlcAssignment = HMS_RLC_Assignment::getAssignmentByUsername($student->getUsername(), Term::getPrevTerm(Term::getCurrentTerm()));

        $view = new RlcReapplicationView($student, $term, $rlcAssignment);

        $context->setContent($view->show());
    }
}

?>