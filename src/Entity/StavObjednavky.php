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

   
}
