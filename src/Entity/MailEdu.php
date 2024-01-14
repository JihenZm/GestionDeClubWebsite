<?php

namespace App\Entity;

use App\Repository\MailEduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[ORM\Entity(repositoryClass: MailEduRepository::class)]
class MailEdu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?String $DateEnvoi = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToMany(targetEntity: Educateur::class)]
    private Collection $Educateurs;

    public function __construct()
    {
        $this->Educateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnvoi(): ?string
    {
        return $this->DateEnvoi;
    }

    public function setDateEnvoi(string $DateEnvoi): static
    {
        $this->DateEnvoi = $DateEnvoi;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, Educateur>
     */
    public function getEducateurs(): Collection
    {
        return $this->Educateurs;
    }

    public function addEducateur(Educateur $educateur): static
    {
        if (!$this->Educateurs->contains($educateur)) {
            $this->Educateurs->add($educateur);
        }

        return $this;
    }

    public function removeEducateur(Educateur $educateur): static
    {
        $this->Educateurs->removeElement($educateur);

        return $this;
    }


   
}
