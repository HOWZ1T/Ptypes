<?php

namespace Ptypes\Exceptions;

use Exception;

class InvalidArgument extends Exception
{
    public function __construct($message="Invalid Argument!", $code = 1, Exception $previous = null) 
	{
        parent::__construct($message, $code, $previous);
    }

    public function __toString() 
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}