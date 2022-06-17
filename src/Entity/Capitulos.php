<?php

namespace App\Entity;

use App\Repository\CapitulosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapitulosRepository::class)]
class Capitulos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descripcion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $link;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Fases::class, inversedBy: 'capitulos')]
    private $fases;

    #[ORM\OneToMany(mappedBy: 'capitulos', targetEntity: TipoLista::class)]
    private $tipolista;

    #[ORM\OneToMany(mappedBy: 'capitulos', targetEntity: Lista::class)]
    private $lista;

    public function __construct()
    {
        $this->tipolista = new ArrayCollection();
        $this->lista = new ArrayCollection();
    }

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

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

    public function getFases(): ?Fases
    {
        return $this->fases;
    }

    public function setFases(?Fases $fases): self
    {
        $this->fases = $fases;

        return $this;
    }

    /**
     * @return Collection<int, TipoLista>
     */
    public function getTipolista(): Collection
    {
        return $this->tipolista;
    }

    public function addTipolistum(TipoLista $tipolistum): self
    {
        if (!$this->tipolista->contains($tipolistum)) {
            $this->tipolista[] = $tipolistum;
            $tipolistum->setCapitulos($this);
        }

        return $this;
    }

    public function removeTipolistum(TipoLista $tipolistum): self
    {
        if ($this->tipolista->removeElement($tipolistum)) {
            // set the owning side to null (unless already changed)
            if ($tipolistum->getCapitulos() === $this) {
                $tipolistum->setCapitulos(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lista>
     */
    public function getLista(): Collection
    {
        return $this->lista;
    }

    public function addListum(Lista $listum): self
    {
        if (!$this->lista->contains($listum)) {
            $this->lista[] = $listum;
            $listum->setCapitulos($this);
        }

        return $this;
    }

    public function removeListum(Lista $listum): self
    {
        if ($this->lista->removeElement($listum)) {
            // set the owning side to null (unless already changed)
            if ($listum->getCapitulos() === $this) {
                $listum->setCapitulos(null);
            }
        }

        return $this;
    }
}
