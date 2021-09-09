<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PagesRepository::class)
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="get creative with the title!"),
    * @Assert\Length(
    * min = 5,
    * max = 50,
    * minMessage = "Le titre doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le titre doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="get creative with the description!"),
    * @Assert\Length(
    * min = 3,
    * max = 50,
    * minMessage = "La description doit comporter au moins {{ limit }} caractères",
    * maxMessage = "La description doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="get creative with details!"),
    * @Assert\Length(
    * min = 5,
    * max = 500,
    * minMessage = "Les details doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Les details doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $pagesdetails;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="get creative and add an image!")
     */
    private $imgPages;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPagesdetails(): ?string
    {
        return $this->pagesdetails;
    }

    public function setPagesdetails(?string $pagesdetails): self
    {
        $this->pagesdetails = $pagesdetails;

        return $this;
    }

    public function getImgPages(): ?string
    {
        return $this->imgPages;
    }

    public function setImgPages(?string $imgPages): self
    {
        $this->imgPages = $imgPages;

        return $this;
    }
}
