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
		$n = new DLNode('some data');
		$list->insert($n);
		$list->insert_after($n, new DLNode('more data'));
		$this->assertEquals($list->lastNode->data, 'more data');
	}
	
	/** @test */
	public function insert_before_does_throw_invalid_argument_exception_for_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_before("Im not a node!", new DLNode('some data'));
	}
	
	/** @test */
	public function insert_before_does_throw_invalid_argument_exception_for_new_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_before(new DLNode('some data'), "Im not a node!");
	}
	
	/** @test */
	public function it_can_insert_before()
	{
		$list = new DoublyLinkedList();
		$n = new DLNode('some data');
		$list->insert($n);
		$list->insert_before($n, new DLNode('more data'));
		$this->assertEquals($list->firstNode->data, 'more data');
	}
	
	/** @test */
	public function insert_beginning_does_throw_invalid_argument_exception_for_new_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_beginning("Im not a node!");
	}
	
	/** @test */
	public function it_can_insert_beginning()
	{
		$list = new DoublyLinkedList();
		$list->insert(new DLNode('more data'));
		$list->insert_beginning(new DLNode('some data'));
		$this->assertEquals($list->firstNode->data, 'some data');
	}
	
	/** @test */
	public function insert_end_does_throw_invalid_argument_exception_for_new_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert_end("Im not a node!");
	}
	
	/** @test */
	public function it_can_insert_end()
	{
		$list = new DoublyLinkedList();
		$list->insert(new DLNode('more data'));
		$list->insert_end(new DLNode('some data'));
		$this->assertEquals($list->lastNode->data, 'some data');
	}
	
	/** @test */
	public function insert_does_throw_invalid_argument_exception_for_new_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->insert("Im not a node!");
	}
	
	/** @test */
	public function it_can_insert()
	{
		$list = new DoublyLinkedList();
		$list->insert(new DLNode('more data'));
		$list->insert(new DLNode('some data'));
		$this->assertEquals($list->lastNode->data, 'some data');
	}
	
	/** @test */
	public function contains_throw_invalid_argument_exception_for_node()
	{
		$this->expectException(UnexpectedType::class);
		$list = new DoublyLinkedList();
		$list->contains("Im not a node!");
	}
	
	/** @test */
	public function contains_returns_true_for_valid_node()
	{
		$list = new DoublyLinkedList();
		$n = new DLNode('1');
		$list->insert(new DLNode('2'))->insert(new DLNode('3'))->insert(new DLNode('4'))->insert($n)->insert(new DLNode('5'));
		$this->assertEquals($list->contains($n), true);
	}
	//TODO finish unit test
}