<?php

namespace App\Handler;

use App\Entity\Student;

class AverageHandler
{
    /**
     * Calculate the general average of a student
     * 
     * @param Student $student
     * @return float|false
     */
    public function studentAverage(Student $student)
    {
        $notesValues = [];
        
        /** @var Student $student */
        $notes = $student->getNotes();

        foreach($notes as $note) {
            $notesValues[] = $note->getValue();
        }

        return \round(\array_sum($notesValues) / \count($notesValues), 2);
    }
}