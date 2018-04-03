<?php

namespace App\DataFixtures;

use App\Entity\Acme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $acme = new Acme();
            $acme->setFieldA($i);
            try {
                $acme->setFieldB(base64_encode(random_bytes(10)));
            } catch (\Exception $e) {
            }
            $manager->persist($acme);
        }

        $manager->flush();
    }
}