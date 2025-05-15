<?php

namespace App\Entity;

use App\Repository\NormalUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class NormalUser extends User
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $isPremium;

    public function isPremium(): ?bool
    {
        return $this->isPremium;
    }

    public function setPremium(bool $isPremium): self
    {
        $this->isPremium = $isPremium;
        return $this;
    }


}
