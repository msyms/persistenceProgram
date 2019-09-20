<?php
abstract class IteratorClass
{
    abstract public function first();
    abstract public function next();
    abstract public function isDone();
    abstract public function currentItem();
}

abstract class Aggregate
{
    abstract function createIterator();
}

class ConcreteIterator extends IteratorClass
{
    private $aggregate;
    private $current = 0;

    function __construct($aggregate)
    {
        $this->aggregate = $aggregate;
    }

    public function first()
    {
        return $this->aggregate[0];
    }

    public function next()
    {
        $ret = null;
        $this->current++;
        if($this->current < count($this->aggregate))
        {
            $ret = $this->aggregate[$this->current];
        }
        return $ret;
    }

    public function isDone()
    {
        return $this->current >= count($this->aggregate);
    }

    public function currentItem()
    {
        return $this->aggregate[$this->current];    
    }
}