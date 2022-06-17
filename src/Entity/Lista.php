<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaRepository::class)]
class Lista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $estado;

    #[ORM\ManyToOne(targetEntity: Capitulos::class, inversedBy: 'lista')]
    private $capitulos;

    #[ORM\ManyToOne(targetEntity: TipoLista::class, inversedBy: 'lista')]
    private $tipoLista;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function __toString(): string
    {
        return $this->nombre;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCapitulos(): ?Capitulos
    {
        return $this->capitulos;
    }

    public function setCapitulos(?Capitulos $capitulos): self
    {
        $this->capitulos = $capitulos;

        return $this;
    }

    public function getTipoLista(): ?TipoLista
    {
        return $this->tipoLista;
    }

    public function setTipoLista(?TipoLista $tipoLista): self
    {
        $this->tipoLista = $tipoLista;

        return $this;
    }
}
