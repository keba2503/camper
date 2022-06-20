<?php
namespace App\EntityListener;

use App\Entity\Fases;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class FasesEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Fases $fases, LifecycleEventArgs $event)
    {
        $fases->computeSlug($this->slugger);
    }

    public function preUpdate(Fases $fases, LifecycleEventArgs $event)
    {
        $fases->computeSlug($this->slugger);
    }
}