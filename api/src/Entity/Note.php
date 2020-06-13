<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NoteRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Student's Note
 * 
 * @ApiResource(
 *      normalizationContext={"groups"={"note:read"}},
 * )
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     * @Assert\NotNull()
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "The value of the note must be between 0 and 20"
     * )
     * @Groups({"note:read", "student:read"})
     */
    private float $value;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Type("string")
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Groups({"note:read", "student:read"})
     */
    private string $course;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     * @Groups({"note:read"})
     */
    private Student $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
