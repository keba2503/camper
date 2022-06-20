<?php

namespace App\EventSubscriber;
use App\Repository\FasesRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
        private $fasesRepository;
    
        public function __construct(Environment $twig, FasesRepository $fasesRepository)
        {
            $this->twig = $twig;
            $this->fasesRepository = $fasesRepository;
        }
    
         public function onControllerEvent(ControllerEvent $event)
         {
            $this->twig->addGlobal('fases', $this->fasesRepository->findAll());
         }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
