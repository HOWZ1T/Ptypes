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
	
	/** @test */
	public function it_can_delete() //Referenced from: https://www.cs.cmu.edu/~adamchik/15-121/lectures/Trees/trees.html
	{
		$root = new TreeNode(8);
		$root->left = new TreeNode(3);
		$root->right = new TreeNode(9);
		
		$root->left->left = new TreeNode(1);
		$root->left->right = new TreeNode(5);
		$root->left->right->left = new TreeNode(4);
		
		$root->right->right = new TreeNode(12);
		$root->right->right->left = new TreeNode(11);
		
		$tree = new BinaryTree($root);
		$tree->delete(9);
		$this->assertEquals($tree->traverse(BinaryTree::IN_ORDER), array(1,3,4,5,8,11,12));
	}
	
	/** @test */
	public function it_can_delete_child_with_two_children() //Referenced from: https://www.cs.cmu.edu/~adamchik/15-121/lectures/Trees/trees.html
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(50));
		$tree->insert(new TreeNode(40));
		$tree->insert(new TreeNode(70));
		$tree->insert(new TreeNode(60));
		$tree->insert(new TreeNode(80));
		$tree->delete(50);
		$this->assertEquals($tree->root->value, 60);
	}
	
	/** @test */
	public function it_can_calculate_tree_height()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(50));
		$tree->insert(new TreeNode(40));
		$tree->insert(new TreeNode(70));
		$tree->insert(new TreeNode(60));
		$tree->insert(new TreeNode(80));
		$this->assertEquals($tree->get_height(), 3);
	}
	
	/** @test */
	public function it_can_get_node_at_given_level()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(50));
		$tree->insert(new TreeNode(40));
		$tree->insert(new TreeNode(70));
		$tree->insert(new TreeNode(60));
		$tree->insert(new TreeNode(80));
		$this->assertEquals($tree->get_level(1)[0]->value, 50);
	}
	
	/** @test */
	public function it_can_get_nodes_given_level()
	{
		$tree = new BinaryTree();
		$tree->insert(new TreeNode(10));
		$tree->insert(new TreeNode(5));
		$tree->insert(new TreeNode(12));
		$tree->insert(new TreeNode(2));
		$tree->insert(new TreeNode(6));
		$tree->insert(new TreeNode(3));
		$this->expectOutputString("lol");
		
		print_r($tree->traverse(BinaryTree::IN_ORDER));
		
		echo "\n\n";
		echo $tree->root->value . " ROOT\n";
		echo $tree->root->left->value . " ROOT LEFT\n";
		echo $tree->root->right->value . " ROOT RIGHT\n";
		echo $tree->root->left->left->value . "  ROOT LEFT -LEFT\n";
		echo $tree->root->left->right->value . "  ROOT LEFT -RIGHT\n";
		echo $tree->root->left->left->right->value . "  ROOT LEFT -LEFT -RIGHT\n\n";
		
		print_r($tree->get_level(3));
		
		echo "\n\n";
		
		$nodes = $tree->traverse(BinaryTree::LEVEL_ORDER);
		
		foreach($nodes as $i => $level)
		{
			foreach($level as $j => $node)
			{
				echo $node->value . " ";
			}
			echo "\n";
		}
	}
}