<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransferRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransferRepository::class)]
#[ApiResource]
class Transfer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $currency = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentMethod = null;

    #[ORM\ManyToOne(inversedBy: 'sentTransfers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TransferAccount $sender = null;

    #[ORM\ManyToOne(inversedBy: 'receivedTransfers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TransferAccount $receiver = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getSender(): ?TransferAccount
    {
        return $this->sender;
    }

    public function setSender(?TransferAccount $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?TransferAccount
    {
        return $this->receiver;
    }

    public function setReceiver(?TransferAccount $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
