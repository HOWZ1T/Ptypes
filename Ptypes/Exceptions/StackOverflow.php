<?php

namespace Ptypes\Exceptions;

use Exception;

class StackOverflow extends Exception
{
    public function __construct($message="Stack Overflow!", $code = 2, Exception $previous = null) 
	{
        parent::__construct($message, $code, $previous);
    }

    public function __toString() 
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}