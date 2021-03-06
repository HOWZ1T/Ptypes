<?php

namespace Ptypes\Exceptions;

use Exception;

class StackUnderflow extends Exception
{
    public function __construct($message="Stack Underflow!", $code = 3, Exception $previous = null) 
	{
        parent::__construct($message, $code, $previous);
    }

    public function __toString() 
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}