<?php

namespace App\Entity;

use App\Repository\FmRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FmRepository::class)]
class FM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\ManyToOne]
    private ?Materijal $materijal = null;


    #[ORM\ManyToOne]
    private ?Format $format = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterijal(): ?Materijal
    {
        return $this->materijal;
    }

    public function setMaterijal(?Materijal $materijal): self
    {
        $this->materijal = $materijal;

        return $this;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setFormat(?Format $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getId();
    }
}
