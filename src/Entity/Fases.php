<?php

namespace App\Entity;

use App\Repository\FasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: FasesRepository::class)]
#[UniqueEntity('slug')]
class Fases
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\OneToMany(mappedBy: 'fases', targetEntity: Capitulos::class)]
    private $capitulos;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $slug;

    public function __construct()
    {
        $this->capitulos = new ArrayCollection();
    }

        public function __toString(): string
    {
        return $this->nombre;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function computeSlug(SluggerInterface $slugger)
    {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = (string) $slugger->slug((string) $this)->lower();
        }
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

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Capitulos>
     */
    public function getCapitulos(): Collection
    {
        return $this->capitulos;
    }

    public function addCapitulo(Capitulos $capitulo): self
    {
        if (!$this->capitulos->contains($capitulo)) {
            $this->capitulos[] = $capitulo;
            $capitulo->setFases($this);
        }

        return $this;
    }

    public function removeCapitulo(Capitulos $capitulo): self
    {
        if ($this->capitulos->removeElement($capitulo)) {
            // set the owning side to null (unless already changed)
            if ($capitulo->getFases() === $this) {
                $capitulo->setFases(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
