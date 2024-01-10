<?php

namespace App\Entity;

use App\Repository\MailContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailContactRepository::class)]
class MailContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateEnvoi = null;

    #[ORM\Column(length: 255)]
    private ?string $Objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Message = null;

    #[ORM\ManyToMany(targetEntity: Licencie::class)]
    private Collection $Licencies;

    public function __construct()
    {
        $this->Licencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->DateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $DateEnvoi): static
    {
        $this->DateEnvoi = $DateEnvoi;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->Objet;
    }

    public function setObjet(string $Objet): static
    {
        $this->Objet = $Objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): static
    {
        $this->Message = $Message;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getLicencies(): Collection
    {
        return $this->Licencies;
    }

    public function addLicency(Licencie $licency): static
    {
        if (!$this->Licencies->contains($licency)) {
            $this->Licencies->add($licency);
        }

        return $this;
    }

    public function removeLicency(Licencie $licency): static
    {
        $this->Licencies->removeElement($licency);

        return $this;
    }
}
