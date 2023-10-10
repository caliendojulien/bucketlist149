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
        $this->assertFalse($wish->isIsPublished());
    }
}
