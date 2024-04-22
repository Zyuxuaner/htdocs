<?php
class test{
    public function __construct() {
        echo 'construct';
    }

    public function sayHello(){
        echo 'hello';
    }
}

$Test = new Test();
echo "<br />";
$Test->sayHello();