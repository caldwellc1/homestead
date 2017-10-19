<?php

namespace Homestead\Command;

use \Homestead\HMS_Activity_Log;
use \Homestead\UserStatus;

class AddNoteCommand extends Command {

    private $username;
    private $note;
    private $banner;

    public function setUsername($username){
        $this->username = $username;
    }

    public function setNote($note){
        $this->note = $note;
    }

    public function setBanner($banner){
        $this->banner = $banner;
    }

    public function getRequestVars()
    {
        $vars = array('action'=>'AddNote');

        if(isset($this->username)){
            $vars['username'] = $this->username;
        }

        if(isset($this->note)){
            $vars['note'] = $this->note;
        }

        if(isset($this->banner)){
            $vars['banner'] = $this->banner;
        }

        return $vars;
    }

    public function execute(CommandContext $context)
    {
        $username = $context->get('username');
        $note = $context->get('note');
        $banner = $context->get('banner');

        if(!isset($username) || empty($username)){
            throw new \InvalidArgumentException('Missing username');
        }

        if(!isset($note) || empty($note)){
            throw new \InvalidArgumentException('No text was provided for the note.');
        }
        if(!isset($banner) || empty($banner)){
            throw new InvalidArgumentException('Missing banner id.');
        }

        $activityLog = new HMS_Activity_Log($username, time(), 'ACTIVITY_ADD_NOTE', UserStatus::getUsername(), $note, $banner);
        $activityLog->save();

        # Redirect back to whereever the user came from
        $context->goBack();
    }
}
