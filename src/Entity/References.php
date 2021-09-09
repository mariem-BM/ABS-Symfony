<?php

namespace App\Entity;

use App\Repository\ReferencesRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ReferencesRepository::class)
 * @ORM\Table(name="`references`")
 */
class References
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refNom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgRef;



    public function getRefNom(): ?string
    {
        return $this->refNom;
    }

    public function setRefNom(?string $refNom): self
    {
        $this->refNom = $refNom;

        return $this;
    }

    public function getImgRef(): ?string
    {
        return $this->imgRef;
    }

    public function setImgRef(string $imgRef): self
    {
        $this->imgRef = $imgRef;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
