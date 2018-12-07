<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatbaRepository")
 */
class Platba
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typPlatby;

    /**
     * @ORM\Column(type="integer")
     */
    private $cena;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objednavka", mappedBy="platba")
     */
    private $objednavky;

    public function __construct()
    {
        $this->objednavky = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypPlatby(): ?string
    {
        return $this->typPlatby;
    }

    public function setTypPlatby(?string $typPlatby): self
    {
        $this->typPlatby = $typPlatby;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Objednavka[]
     */
    public function getObjednavky(): Collection
    {
        return $this->objednavky;
    }

    public function addObjednavky(Objednavka $objednavky): self
    {
        if (!$this->objednavky->contains($objednavky)) {
            $this->objednavky[] = $objednavky;
            $objednavky->setPlatba($this);
        }

        return $this;
    }

    public function removeObjednavky(Objednavka $objednavky): self
    {
        if ($this->objednavky->contains($objednavky)) {
            $this->objednavky->removeElement($objednavky);
            // set the owning side to null (unless already changed)
            if ($objednavky->getPlatba() === $this) {
                $objednavky->setPlatba(null);
            }
        }

        return $this;
    }
}
