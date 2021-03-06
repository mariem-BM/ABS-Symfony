<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true),
     *@Assert\NotBlank(message="Get creative and add of a picture!")
     */
    private $picture;

    /**
    * @ORM\Column(type="string", length=255)
    *@Assert\NotBlank(message="Get creative and think of a title!"),
    * @Assert\Length(
    * min = 3,
    * max = 30,
    * minMessage = "Le titre doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le titre doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
    *@Assert\NotBlank(message="Get creative and think of some content!"),
    * @Assert\Length(
    * min = 5,
    * max = 500,
    * minMessage = "Le content doit comporter au moins {{ limit }} caractères",
    * maxMessage = "Le content doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastUpdateDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublished;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Get creative and think of some content!"),
    * @Assert\Length(
    * min = 5,
    * max = 500,
    * minMessage = "doit comporter au moins {{ limit }} caractères",
    * maxMessage = "doit comporter au plus {{ limit }} caractères"
    * )
     */
    private $readmore;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getLastUpdateDate(): ?\DateTimeInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(\DateTimeInterface $lastUpdateDate): self
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getReadmore(): ?string
    {
        return $this->readmore;
    }

    public function setReadmore(string $readmore): self
    {
        $this->readmore = $readmore;

        return $this;
    }
}
