<?php

namespace Ptypes;

use Ptypes\Exceptions\InvalidArgument;

class TreeNode
{
	public $data;
	public $value;
	public $left;
	public $right;
	
	public function __construct($value, $data=null)
	{
		if(gettype($value) != "integer" && gettype($value) != "int" && gettype($value) != "double")
		{
			throw new InvalidArgument("Expected a number, got: " . gettype($value) . "!");
		}
		$this->value = $value;
		$this->data = $data;
		$this->left = null;
		$this->right = null;
	}
}