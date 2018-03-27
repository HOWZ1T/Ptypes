<?php

namespace Ptypes\Test;

use Ptypes\DLNode;
use Ptypes\DoublyLinkedList;
use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\IndexOutOfBounds;

class DoublyLinkedListTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_can_construct()
	{
		$list = new DoublyLinkedList();
		$this->assertNotEquals($list, null);
	}
	
	/** @test */
	public function insert_after_does_throw_invalid_argument_exception_for_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_after("Im not a node!", new DLNode('some data'));
	}
	
	/** @test */
	public function insert_after_does_throw_invalid_argument_exception_for_new_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_after(new DLNode('some data'), "Im not a node!");
	}
	
	/** @test */
	public function it_can_insert_after()
	{
		$list = new DoublyLinkedList();
		$list->insert(new DLNode('some data'));
		$this->assertEquals($list->firstNode->data, 'some data');
	}
	
	//TODO finish unit test
}