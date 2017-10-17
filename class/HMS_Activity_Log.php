<?php

namespace Homestead;

use \Homestead\Exception\DatabaseException;
use \Homestead\Exception\StudentNotFoundException;

/**
 * The HMS_Activity_Log class
 * Handles logging of various activities and produces the log pager.
 *
 * @author Jeremy Booker <jbooker at tux dot appstate dot edu>
 */

class HMS_Activity_Log{

    public $id;
    public $user_id;
    public $timestamp;
    public $activity;
    public $actor;
    public $notes;
    public $banner_id;
    public $activity_text;

    /**
     * Constructor
     *
     */
    public function __construct($user_id = null, $timestamp = null,
    $activity = null, $actor = null, $notes = null)
    {
        if(!is_null($activity)){
            $this->activity_text = HMS_Activity_Log::get_text_activity($activity);
        }
        $this->id = 0;
        $this->set_user_id($user_id);
        $this->set_timestamp($timestamp);
        $this->set_activity($activity);
        $this->set_actor($actor);
        $this->set_notes($notes);
    }

    public function load($id){
        //change to banner maybe
        $db = PdoFactory::getPdoInstance();
        $sql = "SELECT *
           FROM hms_activity_log
           WHERE user_id = :id";
        $sth = $db->prepare($sql);
        $sth->execute(array('id' => $this->id));
        $result = $sth->fetch();
    }

    public function save(){
        //now to save
        //$activityLog = new HMS_Activity_Log($userid, time(), $activity, $actor, $notes, $banner);
        //$activityLog->save();
        if(UserStatus::isMasquerading()) {
            $this->notes .= " Admin: " . UserStatus::getUsername(FALSE); // get the *real* username
        }
        $db = PdoFactory::getPdoInstance();
        $sql = "INSERT INTO hms_activity_log(user_id, timestamp, activity, actor, notes, banner_id)
            VALUES (:user, :times, (SELECT id FROM hms_activities WHERE activity = :activity), :actor, :notes, :banner)";
        $sth = $db->prepare($sql);
        $sth->execute(array('user' => $this->get_user_id(), 'times' => $this->get_timestamp(),
        'activity' => $this->get_activity(), 'actor' => $this->get_actor(), 'notes' => $this->get_notes(), 'banner' => $this->get_banner_id()));

        return TRUE;
    }

    /**
     * Returns the activities description
     */
    public function get_text_activity_by_action()
    {
        $db = PdoFactory::getPdoInstance();
        $sql = "SELECT description
           FROM hms_activities
           WHERE id = :id";
        $sth = $db->prepare($sql);
        $sth->execute(array('id' => $this->get_activity()));
        $result = $sth->fetchColumn();

        return $result;
    }
    /**
     * Returns a list of all the possible activities
     */
    public static function get_activity_list($unSelect = null){
        $db = PdoFactory::getPdoInstance();
        $sql = "SELECT id
           FROM hms_activities";
        if (!is_null($unSelect)){
            $sql .= " WHERE action != :un";
            $params = array('un' => $unSelect);
        }
        $sth = $db->prepare($sql);
        $sth->execute($params);
        $result = $sth->fetchAll(\PDO::FETCH_COLUMN);

        return $result;
    }

    /**
     * Generates the activity log table
     */
    public function getPagerTags()
    {
        $tpl = array();

        try {
            $student = StudentFactory::getStudentByUsername($this->get_user_id(), Term::getSelectedTerm());
        }catch(StudentNotFoundException $e){
            \NQ::simple('hms', NotificationView::WARNING, "Could not find data for student: {$this->get_user_id()}");
            $student = null;
        }

        if(is_null($student)){
            $tpl['ACTEE'] = 'UNKNOWN';
        }else{
            $tpl['ACTEE'] = $student->getProfileLink();
        }

        if(strcmp($this->get_user_id(),$this->get_actor()) == 0)
        $tpl['ACTOR'] = NULL;
        else
        $tpl['ACTOR'] = $this->get_actor();

        $time = $this->get_timestamp();
        $tpl['DATE'] = date('j M Y', $time);
        $tpl['TIME'] = date('g:i a', $time);


        $tpl['ACTIVITY']  = $this->get_text_activity();

        $notes = $this->get_notes();
        if(!is_null($notes)) {
            $tpl['NOTES'] = $notes;
        }

        return $tpl;
    }

    /******************
     * Mutator Methods *
     ******************/

    public function get_user_id(){
        return $this->user_id;
    }

    public function set_user_id($id){
        $this->user_id = $id;
    }

    public function get_timestamp(){
        return $this->timestamp;
    }

    public function set_timestamp($time){
        $this->timestamp = $time;
    }

    public function get_activity(){
        return $this->activity;
    }

    public function set_activity($activity){
        $this->activity = $activity;
    }

    public function get_actor(){
        return $this->actor;
    }

    public function set_actor($actor){
        $this->actor = $actor;
    }

    public function get_notes(){
        return $this->notes;
    }

    public function set_notes($notes){
        $this->notes = $notes;
    }
}
