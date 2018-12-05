<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazev;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $popis;

    /**
     * @ORM\Column(type="integer")
     */
    private $cena;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pocetKusu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->popis;
    }

    public function setPopis(?string $popis): self
    {
        $this->popis = $popis;

        return $this;
    }

    public function getCena(): ?int
    {
        return $this->cena;
    }

    public function setCena(int $cena): self
    {
        $this->cena = $cena;

        return $this;
    }

    public function getPocetKusu(): ?int
    {
        return $this->pocetKusu;
    }

    public function setPocetKusu(?int $pocetKusu): self
    {
        $this->pocetKusu = $pocetKusu;

        return $this;
    }
}
