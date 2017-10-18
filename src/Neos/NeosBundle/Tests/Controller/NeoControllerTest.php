<?php

namespace Neos\NeosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/hazardous');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIsArray()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/hazardous');

        $data = is_array(json_decode($client->getResponse()->getContent()));

        $this->assertEquals(true, $data);
    }
}
