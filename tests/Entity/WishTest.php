<?php

namespace App\Tests\Entity;

use App\Entity\Wish;
use PHPUnit\Framework\TestCase;

class WishTest extends TestCase
{
    public function testWish(): void
    {
        $wish = new Wish();
        $wish->setAuteur("Moi");
        $wish->setDescription("Une description");
        $wish->setTitle("Un titre");
        $this->assertEquals("Moi", $wish->getAuteur());
        $this->assertNotNull($wish->getDateCreated());
//        $this->assertEqualsWithDelta(new \DateTime(), $wish->getDateCreated(), 5);
        $this->assertFalse($wish->isIsPublished());
    }
}
