<?php

namespace Homestead\Command;

use \Homestead\Term;
use \Homestead\StudentFactory;
use \Homestead\CommandFactory;
use \Homestead\HousingApplicationFactory;
use \Homestead\Exception\PermissionException;
use \Homestead\NotificationView;
use \Homestead\Exception\StudentNotFoundException;

class GroupAssignSetBannerCommand extends Command {

    public function getRequestVars()
    {
        return array('action'=>'GroupAssignSetBanner');
    }

    public function execute(CommandContext $context)
    {
        if(!\Current_User::allow('hms', 'group_assign')){
            throw new PermissionException('You do not have permission to group assign students.');
        }

        $bannerIds = $context->get('banner_ids');

        $term = Term::getSelectedTerm();

        $bannerIds = explode("\n", $bannerIds);

        foreach($bannerIds as $bannerId) {

            // Trim any excess whitespace
            $bannerId = trim($bannerId);

            // Skip blank lines
            if($bannerId == '') {
            	continue;
            }

        	$student = StudentFactory::getStudentByBannerId($bannerId, $term);

            try{
                $application = HousingApplicationFactory::getAppByStudent($student, $term);
            }catch(StudentNotFoundException $e){
                \NQ::simple('hms', NotificationView::ERROR, "No matching student was found for: {$bannerId}");
                continue;
            }

            if(is_null($application)){
                \NQ::simple('hms', NotificationView::ERROR, "No housing application for: {$bannerId}");
                continue;
            }
        }

        if(sizeof($bannerIds) == 1 && $bannerIds[0] == ''){
            \NQ::simple('hms', NotificationView::ERROR, "No Ids entered.");
            $viewCmd = CommandFactory::getCommand('GroupAssignBanner');
            $viewCmd->redirect();
        }else{
            $viewCmd = CommandFactory::getCommand('GroupAssign');
            $viewCmd->redirect();
        }
    }
}
