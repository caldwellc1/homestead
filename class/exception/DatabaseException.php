<?php

namespace Homestead\exception;

class DatabaseException extends HMSException {

    public function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
