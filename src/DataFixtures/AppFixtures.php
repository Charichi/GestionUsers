<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $admin = new Admin();
            $admin->setEmail("admin@admin.com")->setUsername("admin")->setPassword("admin");
            $manager->persist($admin);

        $manager->flush();
    }
}
