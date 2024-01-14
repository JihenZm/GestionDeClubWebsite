<?php

namespace App\Entity;

use App\Repository\EducateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EducateurRepository::class)]
class Educateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;
    
    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = null;

    #[ORM\Column]
    private ?bool $isAdmin  = false;
    
    #[ORM\Column(length: 255)]
    private ?string $numLicence = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn]
    private ?Licencie $Licencie = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(string $numLicence): static
    {
        $this->numLicence = $numLicence;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }


    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): static
    {
        $this->Password = $Password;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getLicencie(): ?Licencie
    {
        return $this->Licencie;
    }

    public function setLicencie(Licencie $Licencie): static
    {
        $this->Licencie = $Licencie;

        return $this;
    }
}
