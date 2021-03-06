<?php

namespace Ptypes\Exceptions;

use Exception;

class UnexpectedType extends Exception
{
    public function __construct($message="Unexpected Type given!", $code = 0, Exception $previous = null) 
	{
        parent::__construct($message, $code, $previous);
    }

    public function __toString() 
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}