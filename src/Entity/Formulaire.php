<?php

namespace App\Entity;

use App\Repository\FormulaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=FormulaireRepository::class)
 */
class Formulaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="add your name!"),
    * @Assert\Length(
    * min = 3,
    * max = 50,
    * minMessage = "Le nom doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le nom doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="add your Last name!"),
    * @Assert\Length(
    * min = 3,
    * max = 50,
    * minMessage = "Le prenom doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le prenom doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="add your email!")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="don't forget what you wanted to tell us!"),
    * @Assert\Length(
    * min = 10,
    * max = 500,
    * minMessage = "Le message doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le message doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
