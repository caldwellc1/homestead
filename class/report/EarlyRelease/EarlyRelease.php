<?php

  class EarlyRelease extends Report implements iCSVReport
  {
    const friendlyName = 'Early Release';
    const shortName = 'Early Release';

    private $term;

    private $total;
    private $transferTotal;
    private $gradTotal;
    private $teachingTotal;
    private $internTotal;
    private $withdrawTotal;
    private $marriageTotal;
    private $abroadTotal;
    private $internationalTotal;


    private $data;


    public function __construct($id = 0)
    {
      parent::__construct($id);

      $term = $this->term;

      $this->total = 0;
      $this->transferTotal = 0;
      $this->gradTotal = 0;
      $this->teachingTotal = 0;
      $this->internTotal = 0;
      $this->withdrawTotal = 0;
      $this->marriageTotal = 0;
      $this->abroadTotal = 0;
      $this->internationTotal = 0;

      $this->data = array();



    }

    public function execute()
    {

      PHPWS_Core::initModClass('hms', 'HMS_Util.php');
      $term = $this->term;

      $db = new PHPWS_DB('hms_new_application');

      $db->addJoin('', 'hms_new_application', 'hms_lottery_application', 'id', 'id');

      $db->addColumn('hms_new_application.username');
      $db->addColumn('hms_new_application.banner_id');
      $db->addColumn('hms_lottery_application.early_release');

      $db->addWhere('hms_new_application.term', $term);

      $db->addOrder(array('hms_lottery_application.early_release ASC', 'hms_new_application.username ASC'));

      $results = $db->select();

      if(PHPWS_Error::isError($results)){
        throw new DatabaseException($results->toString());
      }

      foreach($results as $row)
      {
        $this->total++;

        if($row['early_release'] == 'transfer')
        {
          $row['early_release'] = 'Transferring to another university';
          $this->transferTotal++;
        }
        else if($row['early_release'] == 'grad')
        {
          $row['early_release'] = 'Graduating in December';
          $this->gradTotal++;
        }
        else if($row['early_release'] == 'student_teaching')
        {
          $row['early_release'] = 'Student Teaching';
          $this->teachingTotal++;
        }
        else if($row['early_release'] == 'internship')
        {
          $row['early_release'] = 'Internship';
          $this->internTotal++;
        }
        else if($row['early_release'] == 'withdraw')
        {
          $row['early_release'] = 'Withdrawal';
          $this->withdrawTotal++;
        }
        else if($row['early_release'] == 'marriage')
        {
          $row['early_release'] = 'Getting Married';
          $this->marriageTotal++;
        }
        else if($row['early_release'] == 'study_abroad')
        {
          $row['early_release'] = 'Studying abroad for the Spring';
          $this->abroadTotal++;
        }
        else if($row['early_release'] == 'intl_exchagne')
        {
          $row['early_release'] = 'International Exchange Ending';
          $this->internationalTotal++;
        }



        if(!empty($row['early_release']))
        {
          $row['name'] = StudentFactory::getStudentByBannerId($row['banner_id'], $this->term)->getFullName();

          $this->data[] = $row;
        }

      }
    }

    public function getCsvColumnsArray()
    {
        return array_keys($this->data[0]);
    }

    public function getCsvRowsArray()
    {
        return $this->data;
    }

    public function getData()
    {
      return $this->data;
    }

    public function setTerm($term)
    {
      $this->term = $term;
    }

    public function getTerm()
    {
      return $this->term;
    }

    public function getTotal()
    {
      return $this->total;
    }

    public function getTransfersTotal()
    {
      return $this->transferTotal;
    }

    public function getGradTotal()
    {
      return $this->gradTotal;
    }

    public function getTeachingTotal()
    {
      return $this->teachingTotal;
    }

    public function getInternTotal()
    {
      return $this->internTotal;
    }

    public function getWithdrawTotal()
    {
      return $this->withdrawTotal;
    }

    public function getMarriageTotal()
    {
      return $this->marriageTotal;
    }

    public function getAbroadTotal()
    {
      return $this->abroadTotal;
    }

    public function getInternationalTotal()
    {
      return $this->internationalTotal;
    }

  }

?>
