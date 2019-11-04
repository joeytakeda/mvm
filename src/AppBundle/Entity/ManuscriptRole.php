<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * ManuscriptRole.
 *
 * @ORM\Table(name="manuscript_role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManuscriptRoleRepository")
 */
class ManuscriptRole extends AbstractTerm {
    /**
     * @var Collection|ManuscriptContribution[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ManuscriptContribution", mappedBy="role")
     */
    private $contributions;

    public function __construct() {
        parent::__construct();
        $this->contributions = new ArrayCollection();
    }

    /**
     * Add contribution.
     *
     * @param \AppBundle\Entity\ManuscriptContribution $contribution
     *
     * @return ManuscriptRole
     */
    public function addContribution(ManuscriptContribution $contribution) {
        $this->contributions[] = $contribution;

        return $this;
    }

    /**
     * Remove contribution.
     *
     * @param \AppBundle\Entity\ManuscriptContribution $contribution
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeContribution(ManuscriptContribution $contribution) {
        return $this->contributions->removeElement($contribution);
    }

    /**
     * Get contributions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContributions() {
        return $this->contributions;
    }
}