<?php

namespace App\Test\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class KeyControllerTest extends WebTestCase
{
/*
public function testKeyAuthenticationFailed()
{
    $client = static::createClient();
    $client->request('GET', '/api/keys');
    $this->assertEquals(401, $client->getResponse()->getStatusCode());
}
*/
    /**
     * Get a list of Keys
     *
     * @return void
     */
    public function testListKeys()
    {
        $client = static::createClient([]);
        $client->request('GET', 'api/keys');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Create a Key using GET
     *
     * @return void
     * @throws Exception
     */
    public function testCreateKeyGet()
    {
        $client = static::createClient([]);
        $client->request('GET', 'api/keys/create');
        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    /**
     * Create a Key using POST without sending 'name'
     *
     * @return void
     * @throws Exception
     */
    public function testCreateKeyPost()
    {
        $client = static::createClient([]);
        $client->request('POST', 'api/keys/create');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateKeyOk()
    {
        $client = static::createClient([]);
        $client->request(
            'POST', 
            'api/keys/create',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"name":"testing.name.001"}'
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateKeyDuplicated()
    {
        $client = static::createClient([]);
        $client->request(
            'POST', 
            'api/keys/create',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"name":"testing.name.001"}'
        );
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
