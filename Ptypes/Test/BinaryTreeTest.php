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
	
	/** @test */
	public function it_can_traverse_in_order()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(8))->insert(new TreeNode(5))->insert(new TreeNode(9))->insert(new TreeNode(4))->insert(new TreeNode(14))->insert(new TreeNode(6))->insert(new TreeNode(12));
		$this->assertEquals($tree->traverse(BinaryTree::IN_ORDER), array(4,5,6,8,9,12,14));
	}
	
	/** @test */
	public function it_can_use_custom_made_trees() //Referenced from: https://www.cs.cmu.edu/~adamchik/15-121/lectures/Trees/trees.html
	{
		$root = new TreeNode(8);
		$root->left = new TreeNode(5);
		$root->left->left = new TreeNode(9);
		$root->left->right = new TreeNode(7);
		$root->left->right->left = new TreeNode(1);
		$root->left->right->right = new TreeNode(12);
		$root->left->right->right->left = new TreeNode(2);
		
		$root->right = new TreeNode(4);
		$root->right->right = new TreeNode(11);
		$root->right->right->left = new TreeNode(3);
		
		$tree = new BinaryTree($root);
		$this->assertEquals($tree->traverse(BinaryTree::IN_ORDER), array(9,5,1,7,2,12,8,4,3,11));
	}
	
	/** @test */
	public function it_can_traverse_pre_order() //Referenced from: https://www.cs.cmu.edu/~adamchik/15-121/lectures/Trees/trees.html
	{
		$root = new TreeNode(8);
		$root->left = new TreeNode(5);
		$root->left->left = new TreeNode(9);
		$root->left->right = new TreeNode(7);
		$root->left->right->left = new TreeNode(1);
		$root->left->right->right = new TreeNode(12);
		$root->left->right->right->left = new TreeNode(2);
		
		$root->right = new TreeNode(4);
		$root->right->right = new TreeNode(11);
		$root->right->right->left = new TreeNode(3);
		
		$tree = new BinaryTree($root);
		$this->assertEquals($tree->traverse(BinaryTree::PRE_ORDER), array(8,5,9,7,1,12,2,4,11,3));
	}
	
	/** @test */
	public function it_can_traverse_post_order() //Referenced from: https://www.cs.cmu.edu/~adamchik/15-121/lectures/Trees/trees.html
	{
		$root = new TreeNode(8);
		$root->left = new TreeNode(5);
		$root->left->left = new TreeNode(9);
		$root->left->right = new TreeNode(7);
		$root->left->right->left = new TreeNode(1);
		$root->left->right->right = new TreeNode(12);
		$root->left->right->right->left = new TreeNode(2);
		
		$root->right = new TreeNode(4);
		$root->right->right = new TreeNode(11);
		$root->right->right->left = new TreeNode(3);
		
		$tree = new BinaryTree($root);
		$this->assertEquals($tree->traverse(BinaryTree::POST_ORDER), array(9,1,2,12,7,5,3,11,4,8));
	}
}