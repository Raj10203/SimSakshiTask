<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity]
class NormalUser extends User
{
    use TimestampableEntity;

    #[ORM\Column(nullable: true)]
    private ?bool $isPremium = null;

    public function isPremium(): ?bool
    {
        return $this->isPremium;
    }

    public function setIsPremium(bool $isPremium): self
    {
        $this->isPremium = $isPremium;
        return $this;
    }


}
