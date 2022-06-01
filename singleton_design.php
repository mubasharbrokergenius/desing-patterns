<?php
//problem
// when you create object again and again, then will return first object.
class Singleton
{
    private  static $instance;
    private function __construct()
    {

    }

    public static function createIntance()
    {
        if (self::$instance == null){
            self::$instance = new Singleton();
            echo 'first time'.time().' <br>';
        }
        else
        {
            echo 'second time <br>';
        }


        return self::$instance;
    }

}

function clientCode()
{
    $obj = Singleton::createIntance();
    $obj2 = Singleton::createIntance();

    print_r($obj);
    print_r($obj2);

}

echo 'Call function <br>';
clientCode();
