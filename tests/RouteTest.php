<?php declare(strict_types=1);

require('vendor/autoload.php');

final class RouteTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'https://localhost',
            'verify' => false,
        ]);
    }

    public function testGetSingleSegmentRoute(): void
    {
        $response = $this->client->get('/routing-project/public/patients');

        $this->assertEquals(200, $response->getStatusCode());

        $response->getBody()->rewind();
        $data = json_decode($response->getBody()->__toString());

        $this->assertArrayHasKey('class_name', $data);
        
        $this->assertArrayHasKey('method_name', $data);
        $this->assertEquals('PatientsController', $data['class_name']);
        $this->assertEquals('index', $data['method_name']);
    }
}