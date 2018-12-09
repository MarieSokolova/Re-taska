<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjednavkaRepository")
 */
class Objednavka
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
    private $jmeno;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 9)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ulice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mesto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min = 5, max = 6)
     */
    private $psc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $poznamka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doprava", inversedBy="objednavky")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doprava;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Platba", inversedBy="objednavky")
     * @ORM\JoinColumn(nullable=false)
     */
    private $platba;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zeme", inversedBy="objednavky")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zeme;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getUlice(): ?string
    {
        return $this->ulice;
    }

    public function setUlice(?string $ulice): self
    {
        $this->ulice = $ulice;

        return $this;
    }

    public function getMesto(): ?string
    {
        return $this->mesto;
    }

    public function setMesto(?string $mesto): self
    {
        $this->mesto = $mesto;

        return $this;
    }

    public function getPsc(): ?string
    {
        return $this->psc;
    }

    public function setPsc(?string $psc): self
    {
        $this->psc = $psc;

        return $this;
    }

    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    public function setPoznamka(?string $poznamka): self
    {
        $this->poznamka = $poznamka;

        return $this;
    }

    public function getDoprava(): ?Doprava
    {
        return $this->doprava;
    }

    public function setDoprava(?Doprava $doprava): self
    {
        $this->doprava = $doprava;

        return $this;
    }

    public function getPlatba(): ?Platba
    {
        return $this->platba;
    }

    public function setPlatba(?Platba $platba): self
    {
        $this->platba = $platba;

        return $this;
    }

    public function getZeme(): ?Zeme
    {
        return $this->zeme;
    }

    public function setZeme(?Zeme $zeme): self
    {
        $this->zeme = $zeme;

        return $this;
    }

   
}
