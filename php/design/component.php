<?php
abstract class Component
{
    protected $name;
    
    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add(Component $c);
    abstract public function remove(Component $c);
    abstract public function display($depth);

}

class Leaf extends Component
{
    public function add(Component $c)
    {
        echo "can not add a left";
    }

    public function remove(\Component $c)
    {
        echo "can not remove a leaf";
    }

    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
    }
}

class Composite extends Component
{
    private $children = [];

    public function add(Component $c)
    {
        array_push($this->children, $c);
    }

    public function remove(Component $c)
    {
        foreach($this->children as $key => $value){
            if($c == $value) {
                unset($this->children[$key]);
            }
        }
    }

    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name."\n";
        foreach($this->children as $component) {
            $component->display($depth + 2);
        }
    }
}
$root = new Composite('root');
$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");
$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));

$root->add($comp);

$comp2 = new Composite("Composite X");
$comp2->add(new Leaf("Leaf XA"));
$comp2->add(new Leaf("Leaf XB"));

$comp->add($comp2);

$root->add(new  Leaf("Leaf C"));

$leaf = new Leaf("Leaf D");
$root->add($leaf);
$root->remove($leaf);

$root->display(1);