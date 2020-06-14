<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Note;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testAddStudentNote(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, '/api/notes', ['json' => [
            'value'     => 11.5,
            'course'    => 'geography',
            'student'   => '/api/students/2'
        ]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            "@context"  => "/api/contexts/Note",
            "@type"     => "Note",
            "value"     => 11.5,
            "course"    => "geography",
            "student"   => [
                "@id"   => "/api/students/2",
                "@type" => "Student"
            ]
        ]);
    }

    public function testAddInvalidStudentNote(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, '/api/notes', ['json' => [
            'value' => 25
        ]]);

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertJsonContains([
            '@context'          => '/api/contexts/ConstraintViolationList',
            '@type'             => 'ConstraintViolationList',
            'hydra:title'       => 'An error occurred',
            "hydra:description" => "value: The value of the note must be between 0 and 20\ncourse: This value should not be null.\ncourse: This value should not be blank.\nstudent: This value should not be blank."
        ]);
    }

    public function testDeleteStudentNote(): void
    {
        $client = static::createClient();
        $iri = static::findIriBy(Note::class, ['id' => 6]);

        $client->request(Request::METHOD_DELETE, $iri);

        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
        $this->assertNull(
            static::$container->get('doctrine')
            ->getRepository(Note::class)
            ->findOneBy(['id' => 6])
        );
    }

    public function testUpdateStudentNote(): void
    {
        $client = static::createClient();
        $iri = static::findIriBy(Note::class, ['id' => 6]);

        $client->request(Request::METHOD_PUT, $iri, ['json' => [
            'value'  => 2,
            'course' => 'music'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'value'     => 2,
            'course'    => 'music',
            'student'   => []
        ]);
    }
}