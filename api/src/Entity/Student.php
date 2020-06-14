<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * A student
 *
 * @ApiResource(
 *      normalizationContext={"groups"={"student:read"}, "disable_type_enforcement"=true},
 *      denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ApiFilter(SearchFilter::class, properties={"lastname":"partial", "firstname":"partial", "birthdate":"exact"})
 * @ApiFilter(OrderFilter::class, properties={"lastname", "firstname", "birthdate"})
 * 
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"student:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     * @Groups({"student:read", "note:read"})
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     * @Groups({"student:read", "note:read"})
     */
    private string $firstname;

    /**
     * @Assert\Type(\DateTimeInterface::class, message="This date does not respect the format YYYY-MM-DD")
     * @Assert\NotNull()
     * @ORM\Column(type="datetime")
     * @Groups({"student:read", "note:read"})
     * @var \DateTimeInterface|string
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="student", cascade={"remove"})
     * @Groups({"student:read"})
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setStudent($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
        }

        return $this;
    }
}
