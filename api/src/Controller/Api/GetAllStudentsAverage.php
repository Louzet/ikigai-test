<?php

namespace App\Controller\Api;

use App\Entity\Student;
use App\Handler\AverageHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAllStudentsAverage extends AbstractController
{

    private AverageHandler $averageHandler;

    public function __construct(AverageHandler $averageHandler)
    {
        $this->averageHandler = $averageHandler;
    }
    
    public function __invoke()
    {
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $students = $studentRepository->findAll();

        $data = [];

        /** @var Student $student */
        foreach($students as $student) {
            
            $studentAverage = $this->averageHandler->studentAverage($student);
            
            $data[] = [
                'firstname' => $student->getFirstname(),
                'lastname'  => $student->getLastname(),
                'average'   => $studentAverage
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }
}