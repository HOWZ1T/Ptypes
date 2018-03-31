<?php

namespace Ptypes\Test;

use Ptypes\BinaryTree;
use Ptypes\TreeNode;

class BinaryTreeTest extends \PHPUnit_Framework_TestCase
{	
	/** @test */
	public function it_can_insert()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(11))->insert(new TreeNode(6))->insert(new TreeNode(8))->insert(new TreeNode(19))->insert(new TreeNode(4))->insert(new TreeNode(10))->insert(new TreeNode(5))->insert(new TreeNode(17))->insert(new TreeNode(43))->insert(new TreeNode(49))->insert(new TreeNode(31));
		$this->assertEquals($tree->root->left->right->right->value, 10);
	}
	
	/** @test */
	public function it_can_search()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(11))->insert(new TreeNode(6))->insert(new TreeNode(8))->insert(new TreeNode(19))->insert(new TreeNode(4))->insert(new TreeNode(10))->insert(new TreeNode(5))->insert(new TreeNode(17))->insert(new TreeNode(43))->insert(new TreeNode(49))->insert(new TreeNode(31));
		$this->assertEquals($tree->search(10)->value, 10);
	}
}