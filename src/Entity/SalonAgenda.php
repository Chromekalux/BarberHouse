<?php

namespace App\Entity;

use App\Entity\Salon;
use App\Entity\Agenda;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SalonAgenda extends Agenda
{
    #[ORM\OneToOne(inversedBy: 'agenda', cascade: ['persist', 'remove'])]
    private ?Salon $owner = null;

    public function getOwner(): ?Salon
    {
        return $this->owner;
    }

    public function setOwner(?Salon $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
