<?php
include("./classes/Mankind.php");
include("./classes/Person.php");

use PHPUnit\Framework\TestCase;

final class MankindTest extends TestCase
{
    public function testMenPercent()
    {
        $mankind = Mankind::getInstance();
        $mankind->loadFromCsv("file.csv");
        $this->assertEquals(50, $mankind->getMenPercent());
    }

    public function testGetById(){
        $mankind = Mankind::getInstance();
        $mankind->loadFromCsv("file.csv");
        $this->assertEquals("Petra", $mankind->getPersonById(3457)->getFirstname());
    }

    public function testExceptionGetById(){
        $mankind = Mankind::getInstance();
        $mankind->loadFromCsv("file.csv");
        
        $this->expectException(Exception::class);
        $mankind->getPersonById(0);
    }
}