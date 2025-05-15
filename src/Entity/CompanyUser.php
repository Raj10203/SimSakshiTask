<?php

namespace App\Entity;

use App\Repository\CompanyUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CompanyUser
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $adminLevel;

    public function getAdminLevel(): ?string
    {
        return $this->adminLevel;
    }

    public function setAdminLevel(string $adminLevel): self
    {
        $this->adminLevel = $adminLevel;
        return $this;
    }


}
