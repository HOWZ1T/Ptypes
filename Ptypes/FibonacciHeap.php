<?php

namespace Ptypes;


//NOTES:
/*

n = number of nodes in heap

rank(x) = number of children of node x

rank(H) = max rank of any node in heap H

tree(H) = number of trees in heap H

marks(H) = number of marked nodes in heap H

potential of heap (H) = trees(H) + 2 * marks(H)



operations:
-make fib heap: returns empty heap

-insert: inserts node x whose key field has already been filled in, into the heap

-minimum: returns a pointer to the node with the minimum key in heap H

-extract-min: deletes the node with the minimum key in heap H, returns a pointer to the node

-UNION(H1, H2): creates and returns a new heap that contains all the nodes of H1 and H2, H1 & H2 are destroyed by this operation

-descrease-key(x, k): assigns to node x within the heap H the new key value K, it is assumed that the key <= x: key

-delete(x): deletes node x from heap H
*/

class FibonacciHeap
{
	private $n; //numberr of nodes in heap
	private $min; //pointer to node with minimum key in heap
	private $trees; //trees in the heap
	private $roots;
	
	public function __construct() //cost: O(1)
	{
		$this->n = 0;
		$this->trees = 0;
		$this->min = null;
	}
	
	public function insert($x) //x = node
	{
		//https://www.slideshare.net/anshumanbiswal/fibonacci-heap-15765216
		//todo
		//create tree
		//todo
	}
}