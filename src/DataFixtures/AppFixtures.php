<?php

namespace App\DataFixtures;

use App\Entity\Acme;
use App\Entity\AcmeParent;
use App\Utils\Helper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $acmeParents = [];
        for ($i = 0; $i < 10; $i++) {
            $acmeParent = new AcmeParent();
            $acmeParent->setFieldPA(Helper::randomStringGenerator(10, false));

            $manager->persist($acmeParent);
            $acmeParents[] = $acmeParent;
        }

        for ($i = 0; $i < 20; $i++) {
            $acme = new Acme();
            $acme->setFieldA($i);
            $acme->setFieldB(Helper::randomStringGenerator());

            if ($i < 10) {
                $acme->setAcmeParent($acmeParents[intdiv($i, 2)]);
            }
            $manager->persist($acme);
        }

        $manager->flush();
    }
}