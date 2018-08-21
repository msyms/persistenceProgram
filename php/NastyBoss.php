<?php
abstract class Employee {
	protected $name;
	function __construct( $name ) {
		$this->name = $name;
	}
	abstract function fire();
}

class Minion extends Employee {
	function fire() {
		print "{$this->name}: I'll clear my desk\n";
	}
}

class NastyBossTest {
	private $employees = array();

	function addEmployee( $employeeName ) {
		$this->employees[] = new Minion( $employeeName );
	}
	function projectFails() {
		if(count( $this->employees ) > 0 ) {
			$emp = array_pop( $this->employees );
			$emp->fire();
		}
	}
}
$boss = new NastyBossTest();
$boss->addEmployee("harry");
$boss->addEmployee("bob");
$boss->addEmployee("mary");
$boss->projectFails();

class NastyBoss {
	private $employees = [];

	function addEmployee( Employee $employee) {
		$this->employee[] = $employee;
	}

	function projectFails() {
		if(count($this->employees)) {
			$emp = array_pop( $this->employees );
			$emp->fire();
		}
	}
}

class CluedUp extends Employee {
	function fire() {
		print "{$this->name}: I'll call my lawyer\n";
	}
}

$boss = new NastyBoss();
$boss->addEmployee( new Minion("harry"));
$boss->addEmployee( new CluedUp("bob"));
$boss->addEmployee( new Minion("mary"));

$boss->projectFails();
$boss->projectFails();
$boss->projectFails();