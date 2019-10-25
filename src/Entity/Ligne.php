<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ligne
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
    private $noLigne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoLigne(): ?int
    {
        return $this->noLigne;
    }

    public function setNoLigne(int $noLigne): self
    {
        $this->noLigne = $noLigne;

        return $this;
    }
}
