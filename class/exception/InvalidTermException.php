<?php

namespace Homestead\exception;

class InvalidTermException extends HMSException {

    public function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
