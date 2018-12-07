<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZemeRepository")
 */
class Zeme
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
    private $zemeDoruceni;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objednavka", mappedBy="zeme")
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

    public function getZemeDoruceni(): ?string
    {
        return $this->zemeDoruceni;
    }

    public function setZemeDoruceni(string $zemeDoruceni): self
    {
        $this->zemeDoruceni = $zemeDoruceni;

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
            $objednavky->setZeme($this);
        }

        return $this;
    }

    public function removeObjednavky(Objednavka $objednavky): self
    {
        if ($this->objednavky->contains($objednavky)) {
            $this->objednavky->removeElement($objednavky);
            // set the owning side to null (unless already changed)
            if ($objednavky->getZeme() === $this) {
                $objednavky->setZeme(null);
            }
        }

        return $this;
    }
}
