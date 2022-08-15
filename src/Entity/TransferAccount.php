<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransferAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransferAccountRepository::class)]
#[ApiResource]
class TransferAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $provider = null;

    #[ORM\Column(length: 255)]
    private ?string $identifier = null;

    #[ORM\ManyToOne(inversedBy: 'transferAccounts')]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'transferAccounts')]
    private ?Salon $ownerSalon = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Transfer::class, orphanRemoval: true)]
    private Collection $sentTransfers;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: Transfer::class, orphanRemoval: true)]
    private Collection $receivedTransfers;

    public function __construct()
    {
        $this->sentTransfers = new ArrayCollection();
        $this->receivedTransfers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwnerSalon(): ?Salon
    {
        return $this->ownerSalon;
    }

    public function setOwnerSalon(?Salon $ownerSalon): self
    {
        $this->ownerSalon = $ownerSalon;

        return $this;
    }

    /**
     * @return Collection<int, Transfer>
     */
    public function getSentTransfers(): Collection
    {
        return $this->sentTransfers;
    }

    public function addSentTransfer(Transfer $sentTransfer): self
    {
        if (!$this->sentTransfers->contains($sentTransfer)) {
            $this->sentTransfers->add($sentTransfer);
            $sentTransfer->setSender($this);
        }

        return $this;
    }

    public function removeSentTransfer(Transfer $sentTransfer): self
    {
        if ($this->sentTransfers->removeElement($sentTransfer)) {
            // set the owning side to null (unless already changed)
            if ($sentTransfer->getSender() === $this) {
                $sentTransfer->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transfer>
     */
    public function getReceivedTransfers(): Collection
    {
        return $this->receivedTransfers;
    }

    public function addReceivedTransfer(Transfer $receivedTransfer): self
    {
        if (!$this->receivedTransfers->contains($receivedTransfer)) {
            $this->receivedTransfers->add($receivedTransfer);
            $receivedTransfer->setReceiver($this);
        }

        return $this;
    }

    public function removeReceivedTransfer(Transfer $receivedTransfer): self
    {
        if ($this->receivedTransfers->removeElement($receivedTransfer)) {
            // set the owning side to null (unless already changed)
            if ($receivedTransfer->getReceiver() === $this) {
                $receivedTransfer->setReceiver(null);
            }
        }

        return $this;
    }
}
