<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Agenda;

#[ORM\Entity]
class UserAgenda extends Agenda
{
    #[ORM\OneToOne(inversedBy: 'agenda', cascade: ['persist', 'remove'])]
    private ?User $owner = null;

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
