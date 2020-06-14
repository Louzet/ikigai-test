<?php

namespace App\Controller\Api;

use App\Entity\Student;
use App\Handler\AverageHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAverageGeneral extends AbstractController
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

        $average = 0;

        foreach($students as $student) {
            $average += $this->averageHandler->studentAverage($student);
        }
        $data = \round($average / \count($students), 2);

        return $this->json(['general average' => $data], Response::HTTP_OK);
    }
}