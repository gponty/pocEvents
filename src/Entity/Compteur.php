<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Compteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalLigne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalLigne(): ?int
    {
        return $this->totalLigne;
    }

    public function setTotalLigne(int $totalLigne): self
    {
        $this->totalLigne = $totalLigne;

        return $this;
    }
}
