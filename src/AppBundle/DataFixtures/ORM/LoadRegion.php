<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class LoadRegion extends Fixture {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) {
        $manager->getClassMetadata(Region::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = new Region();
        $item1->setName('Springfield IL');
        $item1->setCreated(new \DateTime('2019-07-29 22:18:40'));
        $item1->setUpdated(new \DateTime('2019-07-29 22:18:40'));
        $this->addReference('_reference_Region1', $item1);
        $manager->persist($item1);

        $manager->flush();
    }
}