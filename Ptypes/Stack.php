<?php

namespace Ptypes;

use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\StackOverflow;
use Ptypes\Exceptions\StackUnderflow;
use Countable;

/**
 * Stack is a last in first out (lifo) data type.
 *
 * functions: push, pop, is_empty, size, peek
 */
class Stack implements Countable
{
	
	private $maxsize;
	private $items;
	private $top;
	
	/**
	 * Stack is a last in first out (lifo) data type.
	 *
	 * @param int $maxsize
	 *
	 * @return Stack
	 */
	public function __construct($maxsize)
	{
		if(gettype($maxsize) != "integer"){throw new UnexpectedType("Expected an integer, got: ".gettype($maxsize));}	
		if($maxsize < 2) {throw new InvalidArgument("Stack has a minimum size of 2!");}
		
		$this->maxsize = $maxsize;
		$this->items = array();	
		$this->top = 0;
	}
	
	/**
	 * Push (add) the item to the Stack.
	 *
	 * @param object $item
	 */
	public function push($item)
	{
		if($this->top == $this->maxsize) {throw new StackOverflow("Pushing this item would overflow the stack (exceed the max stack size)!");}
		$this->items[$this->top++] = $item;
		return $this;
	}
	
	/**
	 * Pop (remove) the top item from the Stack.
	 */
	public function pop()
	{
		if($this->top == 0) {throw new StackUnderflow("Cannot pop an empty stack!");}
		unset($this->items[$this->top--]);
		return $this;
	}
	
	/**
	 * is_empty tests whether the stack is empty.
	 *
	 * @return boolean
	 */
	public function is_empty()
	{
		return ($this->top == 0) ? true : false;
	}
	
	/**
	 * Size, returns the size of the stack.
	 *
	 * @return int
	 */
	public function size()
	{
		return $this->top;
	}
	
	/**
	 * Peek returns the top element of the stack, returns null if the stack is empty.
	 * 
	 * @return object
	 */
	public function peek()
	{
		if($this->top == 0) {return null;}
		return $this->items[$this->top-1];
	}
	
	//Overriding functions & magic methods below
	
	/**
	 * Count, same functionality as Size.
	 * Overrides the default count function call on this class.
	 *
	 * @return int
	 */
	public function count()
	{
		return $this->size();
	}
	
	/**
	 * Overrides the default toString call on this class.
	 *
	 * @return string
	 */
	public function __toString()
	{
		$str = "Stack:\n";
		$str .= ((string)$this->items[$this->top-1])."   <-- top\n";
		for($i = $this->top-2; $i >= 0; $i--)
		{
			$str .= ((string)$this->items[$i])."\n";
		}
		
		return $str;
	}
}