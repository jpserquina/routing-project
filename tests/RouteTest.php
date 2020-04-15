<?php declare(strict_types=1);

require('vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use App\Http\Request\Route;

final class RouteTest extends TestCase
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

        $data = json_decode($response->getBody());

        $this->assertArrayHasKey('class_name', $data);
        $this->assertArrayHasKey('method_name', $data);
        $this->assertEquals('PatientsController', $data['class_name']);
        $this->assertEquals('index', $data['method_name']);
    }
}