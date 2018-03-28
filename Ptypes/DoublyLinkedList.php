<?php

//TODO: Unit Test

namespace Ptypes;

use Countable;
use Ptypes\DLNode;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\IndexOutOfBounds;
use Ptypes\Exceptions\UnexpectedType;

/**
 * DoublyLinkedList is primitive list data structure.
 */
class DoublyLinkedList implements Countable
{
	public $firstNode = null, $lastNode = null; //points to the first and last node of the list

	private $size = 0;

	public function __construct() {}
	
	private function validate_parameter($node)
	{
		if(gettype($node) != "object")
		{
			throw new UnexpectedType("Expected a Ptypes\DLNode, got: " . gettype($node));
		}
		
		if(get_class($node) != "Ptypes\DLNode")
		{
			throw new UnexpectedType("Expected a Ptypes\DLNode, got: " . get_class($node));
		}
	}
	/**
	 * insert_after
	 * Inserts the new node after the given node.
	 *
	 * @param DLNode $node
	 * @param DLNode $newNode
	 */
	public function insert_after($node, $newNode)
	{
		//type checks
		$this->validate_parameter($node);
		$this->validate_parameter($newNode);

		$newNode->prev = $node;
		if ($node->next == null)
		{
			$newNode->next = null;
			$node->next = $newNode;
			$this->lastNode = $newNode;
		}
		else
		{
			$newNode->next = $node->next;
			$node->next->prev = $newNode;
			$node->next = $newNode;
		}
		$this->size += 1;
		return $this; //allows chaining
	}

	/**
	 * insert_before
	 * Inserts the new node before the given node.
	 *
	 * @param DLNode $node
	 * @param DLNode $newNode
	 */
	public function insert_before($node, $newNode)
	{
		//type checks
		$this->validate_parameter($node);
		$this->validate_parameter($newNode);
		
		$newNode->next = $node;
		if ($node->prev == null)
		{
			$newNode->prev = null;
			$node->prev = $newNode;
			$this->firstNode = $newNode;
		}
		else
		{
			$newNode->prev = $node->prev;
			$node->prev->next = $newNode;
			$node->prev = $newNode;
		}
		$this->size += 1;
		return $this; //allows chaining
	}

	/**
	 * insert_beginning
	 * Inserts the new node at the beginning of the list.
	 *
	 * @param DLNode $newNode
	 */
	public function insert_beginning($newNode)
	{	
		//type checks
		$this->validate_parameter($newNode);

		if ($this->firstNode == null)
		{
			$this->firstNode = $newNode;
			$this->lastNode = $newNode;
			$newNode->prev = null;
			$newNode->next = null;
			$this->size += 1;
		}
		else
		{
			$this->insert_before($this->firstNode, $newNode);
		}
		return $this; //allows chaining
	}

	/**
	 * insert_end
	 * Inserts the new node at the end of the list.
	 *
	 * @param DLNode $newNode
	 */
	public function insert_end($newNode)
	{
		//type checks
		$this->validate_parameter($newNode);
		
		if ($this->lastNode == null)
		{
			$this->insert_beginning($newNode);
		}
		else
		{
			$this->insert_after($this->lastNode, $newNode);
		}
		return $this; //allows chaining
	}
	
	/**
	 * Insert
	 * Inserts the new node at the end of the list.
	 *
	 * @param DLNode $newNode
	 */
	public function insert($newNode)
	{
		//type checks
		$this->validate_parameter($newNode);
		$this->insert_end($newNode);
		return $this; //allows chaining
	}

	/**
	 * Contains
	 * Determines whether the list contains the given node.
	 *
	 * @param DLNode $node
	 */
	public function contains($node)
	{
		//type checks
		$this->validate_parameter($node);
		
		$n = $this->firstNode;
		while($n != null)
		{
			if($n == $node)
			{
				return true;
			}
			
			$n = $n->next;
		}

		return false;
	}

	/**
	 * Remove
	 * Removes the given node from the list.
	 *
	 * @param DLNode $node
	 */
	public function remove($node)
	{
		//type checks
		$this->validate_parameter($node);
		
		//check if the node exists
		if ($this->contains($node) === false) 
		{ 
			throw new InvalidArgument("The node given does not exist in this list!"); 
		}

		if ($node->prev == null)
		{
			$this->firstNode = $node->next;
		}
		else
		{
			$node->prev->next = $node->next;
		}

		if ($node->next == null)
		{
			$this->lastNode = $node->prev;
		}
		else
		{
			$node->next->prev = $node->prev;
		}
		$this->size -= 1;
		return $this; //allows chaining
	}

	/**
	 * Get
	 * Gets the node at the given index.
	 *
	 * @param int $index
	 */
	public function get($index)
	{
		if(gettype($index) != "integer")
		{
			throw new UnexpectedType("Expected an integer, got: ".gettype($index));
		}

		if($index < 0 || $index > $this->size-1)
		{
			throw new IndexOutOfBounds("The given index is out of bounds!");
		}

		if($index == 0)
		{
			return $this->firstNode;
		}

		if($index == $this->size-1)
		{
			return $this->lastNode;
		}

		$node = $this->firstNode;
		for($i = 1; $i <= $index; $i++)
		{
			$node = $node->next;
		}

		return $node;
	}

	/**
	 * Size
	 * Gets the size of the list.
	 *
	 * @return int
	 */
	public function size()
	{
		return $this->size;
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
}