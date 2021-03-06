<?php

namespace Ptypes\Test;

use Ptypes\Stack;
use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\StackOverflow;
use Ptypes\Exceptions\StackUnderflow;

class StackTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_throws_unexpected_type_exception()
	{
		$this->expectException(UnexpectedType::class);
		$stack = new Stack('10');
	}
	
	/** @test */
	public function it_throws_invalid_argument_exception()
	{
		$this->expectException(InvalidArgument::class);
		$stack = new Stack(-1);
	}
	
	/** @test */
	public function it_can_create_stack()
	{
		$stack = new Stack(2);
		$this->assertNotEquals($stack, null);
	}
	
	/** @test */
	public function it_can_push()
	{
		$stack = new Stack(2);
		$stack->push('foo');
		$this->assertEquals($stack->peek(), 'foo');
	}
	
	/** @test */
	public function push_on_full_stack_throws_stack_overflow_exception()
	{
		$this->expectException(StackOverflow::class);
		$stack = new Stack(2);
		$stack->push('foo')->push('bar')->push('baz');
	}
	
	/** @test */
	public function it_can_pop()
	{
		$stack = new Stack(2);
		$stack->push('foo');
		$stack->push('bar');
		$stack->pop();
		$this->assertEquals($stack->peek(), 'foo');
	}
	
	/** @test */
	public function pop_on_empty_stack_throws_stack_underflow_exception()
	{
		$this->expectException(StackUnderflow::class);
		$stack = new Stack(3);
		$stack->pop();
	}
	
	/** @test */
	public function is_empty_test_on_empty_stack()
	{
		$stack = new Stack(2);
		$this->assertEquals($stack->is_empty(), true);
	}
	
	/** @test */
	public function is_empty_test_on_non_empty_stack()
	{
		$stack = new Stack(2);
		$this->assertEquals($stack->push('foo')->push('bar')->is_empty(), false);
	}
	
	/** @test */
	public function size_test_on_empty_stack()
	{
		$stack = new Stack(2);
		$this->assertEquals($stack->size(), 0);
	}
	
	/** @test */
	public function size_test_on_non_empty_stack()
	{
		$stack = new Stack(2);
		$this->assertEquals($stack->push('foo')->push('bar')->size(), 2);
	}
	
	/** @test */
	public function peek_on_empty_stack_returns_null()
	{
		$stack = new Stack(5);
		$this->assertEquals($stack->peek(), null);
	}
	
	/** @test */
	public function peek_on_non_empty_stack_returns_item()
	{
		$stack = new Stack(5);
		$stack->push(1)->push(3)->push(2);
		$this->assertEquals($stack->peek(), 2);
	}
	
	/** @test */
	public function count_is_overridden_correctly()
	{
		$stack = new Stack(5);
		$stack->push(1)->push(1)->push(1);
		$this->assertEquals(count($stack), 3);
	}
	
	/** @test */
	public function to_string_is_overridden_correctly()
	{
		$this->expectOutputString("Stack:\n3   <-- top\n2\n1\n");
		$stack = new Stack(5);
		$stack->push(1)->push(2)->push(3);
		echo $stack;
	}
	
	/** @test */
	public function push_and_pop_can_chain()
	{
		$stack = new Stack(3);
		$stack->push('foo')->push('bar')->push('bar')->pop()->push('baz');
		$this->assertEquals($stack->peek(), 'baz');
	}
}