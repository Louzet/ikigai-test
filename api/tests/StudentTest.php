<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Student;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentTest extends ApiTestCase
{

    use RefreshDatabaseTrait;

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

    public function testDeleteStudent(): void
    {
        $client = static::createClient();
        $iri = static::findIriBy(Student::class, ['id' => 8]);

        $client->request(Request::METHOD_DELETE, $iri);

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
        $this->assertNull(
            static::$container->get('doctrine')
            ->getRepository(Student::class)
            ->findOneBy(['id' => 8])
        );
    }

    public function testUpdateStudent()
    {
        $client = static::createClient();
        $iri = static::findIriBy(Student::class, ['id' => 8]);

        $client->request(Request::METHOD_PUT, $iri, ['json' => [
            'firstname' => 'mickael'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@id'       => $iri,
            'id'        => 8,
            'firstname' => 'mickael'
        ]);
    }
}
