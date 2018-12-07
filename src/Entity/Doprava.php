<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DopravaRepository")
 */
class Doprava
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
    private $typDopravy;

    /**
     * @ORM\Column(type="integer")
     */
    private $cena;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objednavka", mappedBy="doprava")
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

    public function getTypDopravy(): ?string
    {
        return $this->typDopravy;
    }

    public function setTypDopravy(?string $typDopravy): self
    {
        $this->typDopravy = $typDopravy;

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
            $objednavky->setDoprava($this);
        }

        return $this;
    }

    public function removeObjednavky(Objednavka $objednavky): self
    {
        if ($this->objednavky->contains($objednavky)) {
            $this->objednavky->removeElement($objednavky);
            // set the owning side to null (unless already changed)
            if ($objednavky->getDoprava() === $this) {
                $objednavky->setDoprava(null);
            }
        }

        return $this;
    }

   
}
