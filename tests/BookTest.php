<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\Book;


use App\Entity\FM;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;


class BookTest extends TestCase

{
    public function testCalculator()
    {
        $fm = new FM();
        $calculator = new Book();
        $calculator->setNrPage(15);
        $calculator->$fm->setPrice(25);


        $result = $calculator->calculate();

        $this->assertEquals(375, $result);
    }
}
