<?php

namespace Neos\NeosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerTest extends WebTestCase
{

    // -- HAZARDOUS
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

    public function testHazardousContent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/hazardous');

        $data = (json_decode($client->getResponse()->getContent()));

        $test = true;

        if (!is_object($data[0])){
            $test = false;
        } else {
            if (!isset($data[0]->date)){
                $test = false;
            }
        }

        $this->assertEquals(true, $test);
    }

    // -- FASTEST
    public function testFastestContent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/fastest');

        $data = (json_decode($client->getResponse()->getContent()));

        $test = true;

        if (!is_object($data[0])){
            $test = false;
        } else {
            if (!isset($data[0]->date)){
                $test = false;
            }

            if (isset($data[0]->is_hazardous)){
                if ($data[0]->is_hazardous == true){
                    $test = false;
                }
            }

        }

        $this->assertEquals(true, $test);
    }

    // -- BEST YEAR
    public function testBestYear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/best-year');

        $data = (json_decode($client->getResponse()->getContent()));

        $test = true;

        if (!is_object($data)){
            $test = false;
        } else {
            if (!isset($data->quantity)){
                $test = false;
            }

            if (isset($data->quantity)){
                if ($data->quantity < 1){
                    $test = false;
                }
            }

        }

        $this->assertEquals(true, $test);
    }

    // -- BEST MONTH
    public function testBestMonth()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/neo/best-month');

        $data = (json_decode($client->getResponse()->getContent()));

        $test = true;

        if (!is_object($data)){
            $test = false;
        } else {
            if (!isset($data->quantity)){
                $test = false;
            }

            if (isset($data->quantity)){
                if ($data->quantity < 1){
                    $test = false;
                }
            }

        }

        $this->assertEquals(true, $test);
    }
}
