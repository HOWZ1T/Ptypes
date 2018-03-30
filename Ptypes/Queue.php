<?php

namespace Ptypes;

use Countable;
use Ptypes\DLNode;
use Ptypes\DoublyLinkedList;

/**
 * Queue
 * Is a First In First Out (FIFO) data structure.
 *
 * Functions: enqueue, dequeue, peek, and size
 */
class Queue implements Countable
{
	/**
	 * Is the doubly linked list which the queue wraps around.
	 */
	private $list;
	
	public function __construct()
	{
		 $this->list = new DoublyLinkedList();
	}
	
	/**
	 * Enqueue
	 * Inserts the element at the tail of the queue.
	 *
	 * @param $object
	 */
	public function enqueue($object)
	{
		$this->list->insert_beginning(new DLNode($object));
		return $this; //allows chaining
	}
	
	/**
	 * Dequeue
	 * Removes the element at the head of the queue.
	 */
	public function dequeue()
	{
		if($this->list->size() == 0) {return $this;}
		$this->list->remove($this->list->lastNode);
		return $this; //allows chaining
	}
	
	/**
	 * Peek
	 * Returns the element at the head of the queue.
	 *
	 * @return object
	 */
	public function peek()
	{
		return $this->list->lastNode->data;
	}
	
	/**
	 * Size
	 * Gets the size of the queue.
	 *
	 * @return int
	 */
	public function size()
	{
		return $this->list->size();
	}
	
	/**
	 * is_empty
	 * Determines if the queue is empty or not.
	 *
	 * @return boolean
	 */
	public function is_empty()
	{
		return ($this->list->size() == 0) ? true : false;
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
		return $this->list->size();
	}
}