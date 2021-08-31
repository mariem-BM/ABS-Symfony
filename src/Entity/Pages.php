<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pagesdetails;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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