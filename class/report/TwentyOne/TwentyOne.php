<?php

/**
 * TwentyOne - Report that calculates % of students 21 or older.
 *
 * @author Jeremy Booker
 * @package HMS
 */

class TwentyOne extends Report implements iCsvReport {

    const friendlyName = 'Students 21 and Older';
    const shortName = 'TwentyOne';

    private $term;

    // Accumulator for output rows (sub-arrays)
    private $rows;

    public function __construct($id = 0)
    {
        parent::__construct($id);

        $this->rows = array();
    }

    public function execute()
    {
        PHPWS_Core::initModClass('hms', 'StudentFactory.php');
        PHPWS_Core::initModClass('hms', 'HMS_Residence_Hall.php');

        if (!isset($this->term) || is_null($this->term)) {
            throw new InvalidArgumentException('Missing term.');
        }

        // Calculate the timestamp from 21 years ago
        $twentyOneYearsAgo = strtotime("-25 years");

        // Get all of the residence halls for this term
        $halls = HMS_Residence_Hall::get_halls($this->term);

        foreach($halls as $hall){
            $hallName = $hall->hall_name;
            $maxOccupancy = $hall->get_number_of_online_nonoverflow_beds();
            $currOccupancy = $hall->get_number_of_assignees();

            $males = 0;
            $females = 0;

            // Get all the assignments for this hall
            $results = $hall->get_assignees();

            if(empty($results)){
                continue;
            }elseif(PEAR::isError($results)){
                throw new DatabaseException($results->toString());
            }

            // foreach assignment, tally up the genders
            foreach($results as $assign){
                if(strtotime($assign->getDob()) < $twentyOneYearsAgo){
                    if($assign->getGender() == MALE){
                        $males++;
                    }else if($assign->getGender() == FEMALE){
                        $females++;
                    }
                }
            }

            if($males == 0){
                $malePercent = 0;
            }else{
                $malePercent = round(($males / $currOccupancy) * 100, 1);
            }

            if($females == 0){
                $femalePercent = 0;
            }else{
                $femalePercent = round(($females / $currOccupancy) * 100, 1);
            }

            $this->rows[] = array('hallName'       => $hallName,
                            'maxOccupancy'   => $maxOccupancy,
                            'currOccupancy'  => $currOccupancy,
                            'males'          => $males,
                            'malePercent'    => $malePercent,
                            'females'        => $females,
                            'femalePercent'  => $femalePercent);
        }
    }

    public function setTerm($term)
    {
        $this->term = $term;
    }

    public function getTerm()
    {
        return $this->term;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getCsvColumnsArray()
    {
        return array('Hall Name', 'Max Occupany', 'Current Occupancy', 'Males', 'Male %', 'Females', 'Female %');
    }

    public function getCsvRowsArray()
    {
        return $this->rows;
    }
}

?>