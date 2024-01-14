<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
class Licencie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isEducateur = false;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $Categorie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $Contact = null;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Educateur $educateur = null;

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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

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

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->Contact;
    }

    public function setContact(Contact $Contact): static
    {
        $this->Contact = $Contact;

        return $this;
    }

    public function getIsEducateur(): ?bool
    {
        return $this->isEducateur;
    }

    public function setIsEducateur(?bool $isEducateur): static
    {
        $this->isEducateur = $isEducateur;

        return $this;
    }

    public function getEducateur(): ?Educateur
    {
        return $this->educateur;
    }

    public function setEducateur(?Educateur $educateur): static
    {
        $this->educateur = $educateur;

        return $this;
    }
}
