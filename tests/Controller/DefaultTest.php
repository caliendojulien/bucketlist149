<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultTest extends WebTestCase
{
    public function testTitre(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1 a', 'Bucket-List');
    }

    public function testFooter(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('footer div', 'Bucket-List');
    }

    public function testNavBar(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $liens = $crawler->filter('nav a');
        $this->assertCount(3, $liens);
        $this->assertSelectorTextContains('h1 a', 'Bucket-List');
    }
}
