<?php

namespace Ptypes\Test;

use Ptypes\Queue;

class QueueTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_can_construct()
	{
		$queue = new Queue();
		$this->assertNotEquals($queue, null);
	}
	
	/** @test */
	public function it_can_enqueue()
	{
		$queue = new Queue();
		$queue->enqueue(1);
		$this->assertEquals($queue->peek(), 1);
	}
	
	/** @test */
	public function it_can_dequeue()
	{
		$queue = new Queue();
		$queue->enqueue(1)->enqueue(2)->enqueue(3)->dequeue()->dequeue();
		$this->assertEquals($queue->peek(), 3);
	}
	
	/** @test */
	public function is_empty_returns_true_for_empty_queue()
	{
		$queue = new Queue();
		$queue->enqueue(1)->dequeue()->dequeue();
		$this->assertEquals($queue->is_empty(), true);
	}
	
	/** @test */
	public function is_empty_returns_false_for_non_empty_queue()
	{
		$queue = new Queue();
		$queue->enqueue(1);
		$this->assertEquals($queue->is_empty(), false);
	}
}