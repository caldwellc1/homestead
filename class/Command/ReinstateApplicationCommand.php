<?php

namespace Homestead\Command;

use \Homestead\HousingApplicationFactory;
use \Homestead\CommandFactory;
use \Homestead\UserStatus;
use \Homestead\HMS_Activity_Log;
use \Homestead\Exception\PermissionException;

class ReinstateApplicationCommand extends Command {

  private $applicationId;


  public function getRequestVars()
  {
      return array('action'=>'ReinstateApplication', 'applicationId' => $this->applicationId);
  }

  public function setAppId($appId)
  {
    $this->applicationId = $appId;
  }

  public function execute(CommandContext $context)
  {
      if(!\Current_User::allow('hms', 'cancel_housing_application'))
      {
          throw new PermissionException('You do not have permission to cancel housing applications.');
      }

      // Check for a housing application id
      $this->setAppId($context->get('applicationId'));

      if(!isset($this->applicationId) || is_null($this->applicationId))
      {
          throw new \InvalidArgumentException('Missing housing application id.');
      }

      $application = HousingApplicationFactory::getApplicationById($this->applicationId);

      $application->setCancelled(0);
      $application->setCancelledBy(null);
      $application->setCancelledReason(null);
      $application->setCancelledOn(null);

      $application->save();

      $activityLog = new HMS_Activity_Log($application->getUsername(), time(), 'ACTIVITY_REINSTATE_APPLICATION', UserStatus::getUsername(), NULL, $banner);
      $activityLog->save();

      $returnCmd = CommandFactory::getCommand('ShowStudentProfile');
      $returnCmd->setBannerId($application->getBannerId());
      $returnCmd->redirect();
  }
}
