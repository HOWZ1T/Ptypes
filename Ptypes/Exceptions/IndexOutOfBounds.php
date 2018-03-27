<?php

namespace Ptypes\Exceptions;

use Exception;

class IndexOutOfBounds extends Exception
{
    public function __construct($message="Index is Out Of Bounds!", $code = 4, Exception $previous = null) 
	{
        parent::__construct($message, $code, $previous);
    }

    public function __toString() 
	{
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}