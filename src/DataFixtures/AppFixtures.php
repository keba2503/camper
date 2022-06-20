<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Fases;
use App\Entity\Capitulos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{

    private $passwordHasherFactory;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory)
    {
        $this->passwordHasherFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager): void
    {
        $amsterdam = new Fases();
        $amsterdam->setNombre('Amsterdam');
        $amsterdam->setDescripcion('2019');
        $manager->persist($amsterdam);

        $paris = new Fases();
        $paris->setNombre('Paris');
        $paris->setDescripcion('2020');
        $manager->persist($paris);

        $comment1 = new Capitulos();
        $comment1->setFases($amsterdam);
        $comment1->setNombre('Fabien');
        $comment1->setDescripcion('fabien@example.com');
        $manager->persist($comment1);


        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(Admin::class)->hash('admin', null));
        $manager->persist($admin);


        $manager->flush();
    }
}
