<?php

namespace Ptypes;

/**
 * Doubly Linked Node (DLNode) is the node element for the DoublyLinkedList.
 */
class DLNode //Doubly Linked Node
{
	public $next = null, $prev = null; //A reference to the next and previous node
	public $data = null; //Data or a reference to data

	/**
	 * DLNode
	 *
	 * @param object $data
	 */
	public function __construct($data=null) 
	{
		$this->data = $data;
	}
}