<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\PrintSource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class PrintSourceFixtures extends Fixture implements DependentFixtureInterface {
    /**
     * Set loading order.
     *
     * @return int
     */
    public function getDependencies() {
        return [LoadRegion::class];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $manager->getClassMetadata(PrintSource::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = new PrintSource();
        $item1->setRegion($this->getReference('_reference_Region1'));
        $item1->setCreated(new \DateTime('2019-07-29 22:19:33'));
        $item1->setUpdated(new \DateTime('2019-07-29 22:19:33'));
        $item1->setName('sgm');
        $item1->setLabel("Springfield Gentleman's Magazine");
        $item1->setDescription('<p>A fictious magazine in Springfield.</p>');
        $this->addReference('_reference_PrintSource1', $item1);
        $manager->persist($item1);

        $manager->flush();
    }
}