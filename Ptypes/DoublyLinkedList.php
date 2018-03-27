<?php

//TODO: Documentation, Unit Test

namespace Ptypes;

use Countable;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\IndexOutOfBounds;

class DLNode //Doubly Linked Node
{
	public $next = null, $prev = null; //A reference to the next and previous node
	public $data = null; //Data or a reference to data
	
	public function __construct($data=null) 
	{
		$this->data = $data;
	}
}

class DoublyLinkedList implements Countable
{
	public $firstNode = null, $lastNode = null; //points to the first and last node of the list
	
	private $size = 0;
	
	public function __construct() {}
	
	public function insert_after($node, $newNode)
	{
		//type checks
		if (get_class($node) != "DLNode") {throw new InvalidArgument("Expected a DLNode, got: " . get_class($node)); }
		if (get_class($newNode) != "DLNode") {throw new InvalidArgument("Expected a DLNode, got: " . get_class($newNode)); }
		
		$newNode->prev = $node;
		if ($node->next == null)
		{
			$newNode->next = null;
			$this->lastNode = $newNode;
		}
		else
		{
			$newNode->next = $node->next;
			$node->next->prev = $newNode;
			$node->next = $newNode;
		}
		$this->size += 1;
	}
	
	public function insert_before($node, $newNode)
	{
		//type checks
		if (get_class($node) != "DLNode") {throw new InvalidArgument("Expected a DLNode, got: " . get_class($node)); }
		if (get_class($newNode) != "DLNode") {throw new InvalidArgument("Expected a DLNode, got: " . get_class($newNode)); }
		
		$newNode->next = $node;
		if ($node->prev == null)
		{
			$newNode->prev = null;
			$this->firstNode = $newNode;
		}
		else
		{
			$newNode->prev = $node->prev;
			$node->prev->next = $newNode;
			$node->prev = $newNode;
		}
		$this->size += 1;
	}
	
	public function insert_beginning($newNode)
	{	
		//type checks
		if (get_class($newNode) != "DLNode") {throw new InvalidArgument("Expected a DLNode, got: " . get_class($newNode)); }
		
		if ($this->firstNode == null)
		{
			$this->firstNode = $newNode;
			$this->lastNode = $newNode;
			$newNode->prev = null;
			$newNode->next = null;
		}
		else
		{
			$this->insert_before($this->firstNode, $newNode);
		}
		$this->size += 1;
	}
	
	public function insert_end($newNode)
	{
		if ($this->lastNode == null)
		{
			$this->insert_beginning($newNode);
		}
		else
		{
			$this->insert_after($this->lastNode, $newNode);
		}
		$this->size += 1;
	}
	
	public function contains($node)
	{
		//check this so we could possibly avoid list traversal
		if ($node == $this->firstNode || $node == $this->lastNode) {return true; }
		
		//traverse the list and try to find the node
		$n = $this->firstNode->next; //we can start one node ahead as we already checked the firstNode
		while ($n != null)
		{
			if ($n == $node) {return true; }
			$n = $n->next;
		}
		
		return false;
	}
	
	public function remove($node)
	{
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
	}
	
	public function get($index)
	{
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