<?php
class HashTable {
	private $buckets;
	private $size = 10;

	public function __construct() {
		$this->buckets = new SplFixedArray($this->size)
	}

	private function hashfunc($key) {
		$strlen = strlen($key);
		$hashval = 0;
		for ($i=0; $i < $strlen ; $i++) { 
			$hashval += ord($key{$i});
			# code...
		}

		return $hashval % $this->size;
	}

	public function insert($key, $val) {
		$index = $this->hashfunc($key);
		//在链表头部插入新的key,value
		if(isset($this->buckets[$index])) {
			//将原来的key,value放到nextNode变量中
			$newNode = new HashNode($key, $value, $this->buckets[$index]);
		} else {
			$newNode = new HashNode($key,$value,NULL);
		}
		//将新key,value放到当前节点，
		$this->buckets[ $index ] = $newNode;
	}

	public function find($key) {
		$index = $this->hashfunc($key);
		$current = $this->buckets[$index];
		while(isset($current)) {
			if($current -> $key == $key) {
				return $current->value;
			}
			$current = $current->nextNode;
		}
		return $this->buckets[ $index ];
	}
}

class HashNode {
	public $key;
	public $value;
	public $nextNode;
	public function __construct($key, $value, $nextNode = NULL) {
		$this->key = $key;
		$this->value = $value;
		$this->nextNode = $nextNode;
	}
}


$ht = new HashTable();
$ht->insert('key1','value1');
$ht->insert('key2','value2');

echo $ht->find('key1');
echo $ht->find('key2');


