<?php

abstract class ShapeFactory
{
    abstract function getShape(): Shape;

    public function draw($name)
    {
        $shape = $this->getShape();
        $shape->draw();
    }

}

class CircleMake extends ShapeFactory
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function getShape(): Shape
    {
        // TODO: Implement getShape() method.
        return new Circle($this->name);
    }
}

class SquareMake extends ShapeFactory
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function getShape(): Shape
    {
        // TODO: Implement getShape() method.
        return new Square($this->name);
    }

}


interface Shape
{
    public function draw();
}

class Circle implements Shape
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function draw()
    {
        // TODO: Implement draw() method.
        echo 'Draw '.$this->name.'<br>';
    }
}
class Square implements Shape
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function draw()
    {
        // TODO: Implement draw() method.
        echo 'Draw '.$this->name.'<br>';
    }
}

function mainFun(ShapeFactory $creator)
{
    $creator->draw("circle");
//    $creator->post("I had a large hamburger this morning!");
}

echo "Testing ConcreteCreator1:\n"."<br>";
mainFun(new CircleMake("circle", "******"));
echo "\n\n"."<br>";

echo "Testing ConcreteCreator2:\n"."<br>";
mainFun(new SquareMake("squre", "******"));
echo "\n\n"."<br>";