<?php

namespace Ptypes;

use Ptypes\TreeNode;
use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;

class BinaryTree
{
	public const IN_ORDER = 0;
	public const PRE_ORDER = 1;
	public const POST_ORDER = 2;
	
	public $root;
	
	public function __construct($root=null)
	{
		$this->root = $root;
	}
	
	public function insert($node) //$node is a treenode
	{
		$this->validate_parameter($node);
		
		if($this->root == null)
		{
			$this->root = $node;
			return $this;
		}
		
		$n = $this->root;
		while(1)
		{	
			if($node->value < $n->value)
			{
				if($n->left == null)
				{
					$n->left = $node;
					return $this;
				}
				
				$n = $n->left;
			}
			else if($node->value > $n->value)
			{
				if($n->right == null)
				{
					$n->right = $node;
					return $this;
				}
				
				$n = $n->right;
			}
			else if($node->value == $n->value) //node is already in the tree, we do not create duplicates!
			{
				return $this;
			}
		}
	}
	
	public function search($value)
	{
		if(gettype($value) != "integer" && gettype($value) != "int" && gettype($value) != "double")
		{
			throw new InvalidArgument("Expected a number, got: " . gettype($value) . " !\n");
		}
		
		return $this->recursive_search($value, $this->root);
	}
	
	private function recursive_search($value, $node)
	{
		if($node == null)
		{
			return null;
		}
		
		$eval = $value - $node->value;
		if($eval == 0)
		{
			return $node;
		}
		
		if($eval < 0)
		{
			return $this->recursive_search($value, $node->left);
		}
		else if($eval > 0)
		{
			return $this->recursive_search($value, $node->right);
		}
	}
	
	public function delete($value)
	{
		//TODO
	}
	
	public function is_complete()
	{
		//TODO
	}
	
	public function traverse($order)
	{
		switch($order)
		{
			case self::IN_ORDER:
				$this->in_order_traversal($this->root);
				break;
				
			case self::PRE_ORDER:
				//TODO
				break;
				
			case self::POST_ORDER:
				//TODO
				break;
				
			default:
				throw new InvalidArgument("Invalid order: " . $order . "! Valid orders: IN_ORDER (BinaryTree::IN_ORDER), PRE_ORDER (BinaryTree::PRE_ORDER), and POST_ORDER (BinaryTree::POST_ORDER).\n");
		}
	}
	
	private function in_order_traversal($node)
	{
		//TODO RETURN ARRAY OF RESULTS
		if ($node == null)
		{
			return null;
		}
		
		$this->in_order_traversal($node->left);
		
		echo $node->value . " ";
		
		$this->in_order_traversal($node->right);
	}
	
	private function validate_parameter($node)
	{
		if(gettype($node) != "object")
		{
			throw new UnexpectedType("Expected a Ptypes\TreeNode, got: " . gettype($node));
		}
		
		if(get_class($node) != "Ptypes\TreeNode")
		{
			throw new UnexpectedType("Expected a Ptypes\TreeNode, got: " . get_class($node));
		}
	}
}