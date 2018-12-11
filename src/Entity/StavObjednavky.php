<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StavObjednavkyRepository")
 */
class StavObjednavky
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
    private $stav;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objednavka", mappedBy="stavObjednavky")
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

    public function getStav(): ?string
    {
        return $this->stav;
    }

    public function setStav(string $stav): self
    {
        $this->stav = $stav;

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
            $objednavky->setStavObjednavky($this);
        }

        return $this;
    }

    public function removeObjednavky(Objednavka $objednavky): self
    {
        if ($this->objednavky->contains($objednavky)) {
            $this->objednavky->removeElement($objednavky);
            // set the owning side to null (unless already changed)
            if ($objednavky->getStavObjednavky() === $this) {
                $objednavky->setStavObjednavky(null);
            }
        }

        return $this;
    }
}
