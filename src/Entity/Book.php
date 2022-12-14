<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $bookPrice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $about = null;

    #[ORM\Column]
    private ?int $nrpage = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?FM $FM = null;

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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }


    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getFM(): ?FM
    {
        return $this->FM;
    }

    public function setFM(?FM $FM): self
    {
        $this->FM = $FM;

        return $this;
    }

    /**
     * Get the value of bookPrice
     */
    public function getBookPrice(): ?string
    {
        return $this->bookPrice;
    }

    /**
     * Set the value of bookPrice
     *
     * @return  self
     */
    public function setBookPrice(string $bookPrice): self
    {
        $this->bookPrice = $bookPrice;

        return $this;
    }

    /**
     * Get the value of nrpage
     */
    public function getNrpage()
    {
        return $this->nrpage;
    }

    /**
     * Set the value of nrpage
     *
     * @return  self
     */
    public function setNrpage($nrpage)
    {
        $this->nrpage = $nrpage;

        return $this;
    }

    public function calculate($nrpage, $price)
    {
        return $nrpage * $price;
    }
}
