<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentTest extends ApiTestCase {

    public function testCreateStudent(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, '/api/students', ['json' => [
            'lastname'  => 'hugo',
            'firstname' => 'valentin',
            'birthdate' => '2008-08-04'
        ]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@context"  => "/api/contexts/Student",
            "@type"     => "Student",
            "lastname"  => "hugo",
            "firstname" => "valentin",
            "birthdate" => "2008-08-04T00:00:00+00:00"
        ]);
    }

    public function testCreateInvalidStudent(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, '/api/students', ['json' => [
            'birthdate' => 'Hello'
        ]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertJsonContains([
            '@context'    => '/api/contexts/ConstraintViolationList',
            '@type'       => 'ConstraintViolationList',
            'hydra:title' => 'An error occurred',
            "hydra:description" => "lastname: This value should not be blank.\nfirstname: This value should not be blank.\nbirthdate: This date does not respect the format YYYY-MM-DD"
        ]);
    }
}
