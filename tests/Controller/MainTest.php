<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainTest extends WebTestCase
{
    public function testImageAboutUs(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about-us');

        $this->assertResponseIsSuccessful();

        $images = $crawler->filter('main div img');
        $this->assertCount(3, $images);
    }

    public function testAccueil(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h2', "Ceci est la page d'accueil");
    }
}
