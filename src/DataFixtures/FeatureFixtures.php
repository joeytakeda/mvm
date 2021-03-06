<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Feature;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class FeatureFixtures extends Fixture {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $manager->getClassMetadata(Feature::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = new Feature();
        $item1->setCreated(new DateTimeImmutable('2019-07-29 22:10:36'));
        $item1->setUpdated(new DateTimeImmutable('2019-07-29 22:10:36'));
        $item1->setName('glue_binding');
        $item1->setLabel('Glue Binding');
        $item1->setDescription('<p>The binding is glue holding the pages to a spine.</p>');
        $this->addReference('_reference_Feature1', $item1);
        $manager->persist($item1);

        $manager->flush();
    }
}
