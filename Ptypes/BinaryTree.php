<?php

namespace Ptypes;

use Countable;
use Ptypes\TreeNode;
use Ptypes\Exceptions\UnexpectedType;
use Ptypes\Exceptions\InvalidArgument;

class BinaryTree implements Countable
{
	public const IN_ORDER = 0;
	public const PRE_ORDER = 1;
	public const POST_ORDER = 2;
	public const LEVEL_ORDER = 3;
	
	public $root;
	
	private $count = 0;
	
	public function __construct(&$root=null)
	{
		if($root != null)
		{
			$this->validate_parameter($root);
		}
		
		$this->root = $root;
		$this->count = ($root == null) ? 0 : 1;
	}
	
	public function insert($node) //$node is a treenode
	{
		$this->validate_parameter($node);
		
		$this->count++;
		
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
	
	public function get_min($node)
	{
		while($node->left != null) //find left most leaf
		{
			$node = $node->left;
		}
		return $node;
	}
	
	public function compare($nodeA, $nodeB)
	{
		$this->validate_parameter($nodeA);
		$this->validate_parameter($nodeB);
		
		$eval = $nodeA->value - $nodeB->value;
		
		if($eval < 0)
		{
			return -1; //go left
		}
		
		if($eval > 0)
		{
			return 1; //go right
		}
		
		return 0; //equal
	}
	
	public function delete($value)
	{
		//check if value is in the tree
		$node = $this->search($value); //this function also handles type checking
		if($node != null)
		{
			$this->delete_recursive($this->root, $node->value);
		}
		
		$this->count--;
		return $this; //allows chaining
	}
	
	private function delete_recursive(&$parent, $value)
	{
		if($parent == null) 
		{
			return $parent;
		}
		
		if($value < $parent->value)
		{
			$parent->left = $this->delete_recursive($parent->left, $value);
		}
		else if($value > $parent->value)
		{
			$parent->right = $this->delete_recursive($parent->right, $value);
		}
		else
		{
			if($parent->left == null)
			{
				$temp = $parent->right;
				$parent = null;
				return $temp;
			}
			else if($parent->right == null)
			{
				$temp = $parent->left;
				$parent = null;
				return $temp;
			}
			
			$temp = $this->get_min($parent->right);
			$parent->value = $temp->value;
			$parent->right = $this->delete_recursive($parent->right, $temp->value);
		}
		
		return $parent;
	}
	
	public function size()
	{
		return $this->count + 1;
	}
	
	public function get_height()
	{
		return $this->get_height_recursive($this->root);
	}
	
	private function get_height_recursive($node)
	{
		if($node == null)
		{
			return 0;
		}
		
		$lHeight = $this->get_height_recursive($node->left);
		$rHeight = $this->get_height_recursive($node->right);
		
		if($lHeight > $rHeight)
		{
			return ($lHeight + 1);
		}
		else
		{
			return ($rHeight + 1);
		}
	}
	
	public function get_level($level)
	{
		if(gettype($level) != "integer" && gettype($level) != "int")
		{
			throw new InvalidArgument("Expected an int, got: " . gettype($level) . " !");
		}
		
		$h = $this->get_height();
		if($level > $h)
		{
			throw new InvalidArgument("Cannot get the level: " . $level . " as it is greater than the tree level of: " . $h . " !");
		}
		
		$results = array();
		$this->get_level_recursive($level, $this->root, $results);
		return $results;
	}
	
	private function get_level_recursive($level, $node=null, &$results) //it is important that reference to results stays a reference (php pointer) !
	{
		if($node == null)
		{
			return null;
		}
		
		if($level == 1)
		{
			array_push($results, $node);
		}
		else if($level > 1)
		{
			$this->get_level_recursive($level-1, $node->left, $results);
			$this->get_level_recursive($level-1, $node->right, $results);
		}
	}
	
	public function traverse($order)
	{
		switch($order)
		{
			case self::IN_ORDER:
				$results = array();
				$this->in_order_traversal($this->root, $results);
				return $results;
				
			case self::PRE_ORDER:
				$results = array();
				$this->pre_order_traversal($this->root, $results);
				return $results;
				
			case self::POST_ORDER:
				$results = array();
				$this->post_order_traversal($this->root, $results);
				return $results;
				
			case self::LEVEL_ORDER:
				$results =array();
				$this->level_order_traversal($results);
				return $results;
				
			default:
				throw new InvalidArgument("Invalid order: " . $order . "! Valid orders: IN_ORDER (BinaryTree::IN_ORDER), PRE_ORDER (BinaryTree::PRE_ORDER), POST_ORDER (BinaryTree::POST_ORDER) and LEVEL_ORDER (BinaryTree::LEVEL_ORDER).\n");
		}
	}
	
	private function in_order_traversal($node, &$results) //it is important that reference to results stays a reference (php pointer) !
	{
		if ($node == null)
		{
			return null;
		}
		
		$this->in_order_traversal($node->left, $results);
		
		array_push($results, $node->value);
		
		$this->in_order_traversal($node->right, $results);
	}
	
	private function pre_order_traversal($node, &$results) //it is important that reference to results stays a reference (php pointer) !
	{
		if ($node == null)
		{
			return null;
		}
		
		array_push($results, $node->value);
		
		$this->pre_order_traversal($node->left, $results);
		$this->pre_order_traversal($node->right, $results);
	}
	
	private function post_order_traversal($node, &$results) //it is important that reference to results stays a reference (php pointer) !
	{
		if ($node == null)
		{
			return null;
		}
		
		$this->post_order_traversal($node->left, $results);
		$this->post_order_traversal($node->right, $results);
		
		array_push($results, $node->value);
	}
	
	private function level_order_traversal(&$results)
	{
		for($i = 1; $i <= $this->get_height(); $i++)
		{
			$results[$i] = $this->get_level($i);
		}
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
	
	//Overriding functions & magic methods below

	/**
	 * Count, same functionality as Size.
	 * Overrides the default count function call on this class.
	 *
	 * @return int
	 */
	public function count()
	{
		return $this->count + 1;
	}
}