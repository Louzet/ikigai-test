<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
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
     */
    private float $value;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Type("string")
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private string $course;

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
}
