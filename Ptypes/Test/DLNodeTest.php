<?php

namespace Ptypes\Test;

use Ptypes\DLNode;

class DLNodeTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_can_construct_with_no_data()
	{
		$node = new DLNode();
		$this->assertEquals($node->data, null);
		$this->assertEquals($node->prev, null);
		$this->assertEquals($node->next, null);
	}
	
	/** @test */
	public function it_can_construct_with_data()
	{
		$node = new DLNode("foobar");
		$this->assertEquals($node->data, "foobar");
	}
	
	/** @test */
	public function it_can_chain_previous_nodes()
	{
		$node = new DLNode('1');
		$node->prev = new DLNode('2');
		$node->prev->prev = new DLNode('3');
		
		$pn = $node->prev->prev->data;
		$this->assertEquals($pn, '3');
	}
	
	/** @test */
	public function it_can_chain_next_nodes()
	{
		$node = new DLNode('1');
		$node->next = new DLNode('2');
		$node->next->next = new DLNode('3');
		
		$pn = $node->next->next->data;
		$this->assertEquals($pn, '3');
	}
}