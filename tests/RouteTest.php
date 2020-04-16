<?php declare(strict_types=1);

require('../vendor/autoload.php');

final class RouteTest extends PHPUnit_Framework_TestCase
{
    protected $client;
    protected $prefix;

    protected function setUp(): void
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'https://localhost',
            'verify' => false,
        ]);

        $this->prefix = '/routing-project/public';
    }

    /**
     * GET: /patients
     */
    public function testIndexPatientsRoute(): void
    {
        $response = $this->client->get($this->prefix . '/patients');
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsController::index', $data['action']);
    }

    /**
     * GET: /patients/2
     */
    public function testGetPatientsRoute(): void
    {
        $response = $this->client->get($this->prefix . '/patients/2');
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsController::get', $data['action']);
    }

    /**
     * POST: /patients
     * Basic Auth payload
     */
    public function testCreatePatientsRoute(): void
    {
        $response = $this->client->post($this->prefix . '/patients', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsController::create', $data['action']);
    }

    /**
     * PATCH: /patients
     * Basic Auth payload
     */
    public function testUpdatePatientsRoute(): void
    {
        $response = $this->client->patch($this->prefix . '/patients/2', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsController::update', $data['action']);
    }

    /**
     * DELETE: /patients
     * Basic Auth payload
     */
    public function testDeletePatientsRoute(): void
    {
        $response = $this->client->delete($this->prefix . '/patients/2', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsController::delete', $data['action']);
    }

    /**
     * GET: /patients/2/metrics
     */
    public function testIndexPatientsMetricsRoute(): void
    {
        $response = $this->client->get($this->prefix . '/patients/2/metrics');
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsMetricsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsMetricsController::index', $data['action']);
    }

    /**
     * GET: /patients/2/metrics/abc
     */
    public function testGetPatientsMetricsRoute(): void
    {
        $response = $this->client->get($this->prefix . '/patients/2/metrics/abc');
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsMetricsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsMetricsController::get', $data['action']);
    }

    /**
     * POST: /patients/2/metrics
     * Basic Auth payload
     */
    public function testCreatePatientsMetricsRoute(): void
    {
        $response = $this->client->post($this->prefix . '/patients/2/metrics', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsMetricsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsMetricsController::create', $data['action']);
    }

    /**
     * PATCH: /patients/2/metrics/abc
     * Basic Auth payload
     */
    public function testUpdatePatientsMetricsRoute(): void
    {
        $response = $this->client->patch($this->prefix . '/patients/2/metrics/abc', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsMetricsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsMetricsController::update', $data['action']);
    }

    /**
     * DELETE: /patients/2/metrics/abc
     * Basic Auth payload
     */
    public function testDeletePatientsMetricsRoute(): void
    {
        $response = $this->client->delete($this->prefix . '/patients/2/metrics/abc', ['auth' => ['username', 'password']]);
        $data = json_decode($response->getBody()->__toString(), true);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('model', $data);

        $this->assertEquals('App\Http\Controllers\PatientsMetricsController', $data['model']);
        $this->assertEquals('App\Http\Controllers\PatientsMetricsController::delete', $data['action']);
    }
}