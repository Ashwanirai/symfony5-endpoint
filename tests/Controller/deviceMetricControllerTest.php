<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;


class deviceMetricControllerTest extends WebTestCase
{
    public function testDeviceMetric()
    {
        $client = static::createClient();
        $client->request('GET', '/api/device');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $client->request('GET', '/api/device?filter[d.model]=Dell R210Intel Xeon X3440');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}