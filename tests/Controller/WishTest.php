<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WishTest extends WebTestCase
{
    public function testWishList(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/wish/list');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Liste des souhaits');
    }
}
