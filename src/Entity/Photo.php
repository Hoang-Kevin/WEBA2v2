<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPhoto(): ?string
    {
        return $this->id_photo;
    }

    public function setIdPhoto(string $id_photo): self
    {
        $this->id_photo = $id_photo;

        return $this;
    }
}
