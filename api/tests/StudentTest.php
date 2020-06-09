<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;

class StudentTest extends ApiTestCase {

    public function testCreateStudent(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, '/api/students');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}
