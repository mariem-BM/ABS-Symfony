<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
   /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;
    /**
    * @ORM\Column(type="string", length=255)
    *@Assert\NotBlank(message="Get creative and think of a title!"),
    * @Assert\Length(
    * min = 3,
    * max = 30,
    * minMessage = "Le nom d'un service doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le nom d'un service doit comporter au plus {{ limit }} caractères"
    * )
    */
    private $nom;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank(message="Get creative and think of a description!"),
    * @Assert\Length(
    * min = 5,
    * max = 500,
    * minMessage = "La description d'un service doit comporter au moins {{ limit }} caractères",
    * maxMessage = "La description d'un service doit comporter au plus {{ limit }} caractères"
    * )
    */
    private $description;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank(message="Get creative and think of details!"),
    * @Assert\Length(
    * min = 5,
    * minMessage = "Les details d'un service doit comporter au moins {{ limit }} caractères"
    * )
    */
    private $details;

    /**
     * @ORM\Column(type="string", length=255),
     * @Assert\NotBlank(message="Get creative and add of image!")
     */
    private $img;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }
}
