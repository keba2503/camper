<?php

namespace App\Entity;

use App\Repository\TipoListaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoListaRepository::class)]
class TipoLista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: Capitulos::class, inversedBy: 'tipolista')]
    private $capitulos;

    #[ORM\OneToMany(mappedBy: 'tipoLista', targetEntity: Lista::class)]
    private $lista;

    public function __construct()
    {
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

    public function getCapitulos(): ?Capitulos
    {
        return $this->capitulos;
    }

    public function setCapitulos(?Capitulos $capitulos): self
    {
        $this->capitulos = $capitulos;

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
            $listum->setTipoLista($this);
        }

        return $this;
    }

    public function removeListum(Lista $listum): self
    {
        if ($this->lista->removeElement($listum)) {
            // set the owning side to null (unless already changed)
            if ($listum->getTipoLista() === $this) {
                $listum->setTipoLista(null);
            }
        }

        return $this;
    }
}
