<?php

namespace App\Controller\Api;

use App\Entity\Student;
use App\Handler\AverageHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetStudentAverage extends AbstractController
{
    private AverageHandler $averageHandler;

    public function __construct(AverageHandler $averageHandler)
    {
        $this->averageHandler = $averageHandler;
    }

    public function __invoke($id)
    {
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $student = $studentRepository->findOneBy(['id' => $id]);
        
        $studentAverage = $this->averageHandler->studentAverage($student);
        
        $data = [
            'firstname' => $student->getFirstname(),
            'lastname'  => $student->getLastname(),
            'average'   => $studentAverage
        ];
        
        return $this->json($data, Response::HTTP_OK);
    }
}