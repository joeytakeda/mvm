<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * ManuscriptFeature
 *
 * @ORM\Table(name="manuscript_feature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManuscriptFeatureRepository")
 */
class ManuscriptFeature extends AbstractEntity
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $note;

    /**
     * @var Feature
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Feature", inversedBy="manuscriptFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    /**
     * @var Manuscript
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Manuscript", inversedBy="manuscriptFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manuscript;

    /**
     * @var Collection|Image[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="feature")
     */
    private $images;

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return get_class() . ' #' . $this->id;
    }

    /**
     * Set feature.
     *
     * @param \AppBundle\Entity\Feature $feature
     *
     * @return ManuscriptFeature
     */
    public function setFeature(\AppBundle\Entity\Feature $feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature.
     *
     * @return \AppBundle\Entity\Feature
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * Set manuscript.
     *
     * @param \AppBundle\Entity\Manuscript $manuscript
     *
     * @return ManuscriptFeature
     */
    public function setManuscript(\AppBundle\Entity\Manuscript $manuscript)
    {
        $this->manuscript = $manuscript;

        return $this;
    }

    /**
     * Get manuscript.
     *
     * @return \AppBundle\Entity\Manuscript
     */
    public function getManuscript()
    {
        return $this->manuscript;
    }

    /**
     * Add image.
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return ManuscriptFeature
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image.
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        return $this->images->removeElement($image);
    }

    /**
     * Get images.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
