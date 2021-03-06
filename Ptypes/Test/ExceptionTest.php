<?php

namespace Ptypes\Test;

use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;
use Ptypes\Exceptions\StackOverflow;
use Ptypes\Exceptions\StackUnderflow;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_can_throw_unexpected_type_exception()
	{
		$this->expectException(UnexpectedType::class);
		throw new UnexpectedType();
	}
	
	/** @test */
	public function it_can_throw_invalid_argument_exception()
	{
		$this->expectException(InvalidArgument::class);
		throw new InvalidArgument();
	}
	
	/** @test */
	public function it_can_throw_stack_overflow_exception()
	{
		$this->expectException(StackOverflow::class);
		throw new StackOverflow();
	}
	
	/** @test */
	public function it_can_throw_stack_underflow_exception()
	{
		$this->expectException(StackUnderflow::class);
		throw new StackUnderflow();
	}
}