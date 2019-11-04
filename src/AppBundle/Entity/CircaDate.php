<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nines\UtilBundle\Entity\AbstractEntity;

define('CIRCA_RE', '(c?)([1-9][0-9]{3})');
define('YEAR_RE', '/^' . CIRCA_RE . '$/');
define('RANGE_RE', '/^(?:' . CIRCA_RE . ')?-(?:' . CIRCA_RE . ')?$/');

/**
 * Date.
 *
 * @ORM\Table(name="circa_date")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CircaDateRepository")
 */
class CircaDate extends AbstractEntity {
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $value;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $start;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default": false})
     */
    private $startCirca;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $end;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default": false})
     */
    private $endCirca;

    public function __construct() {
        parent::__construct();
        $this->start = null;
        $this->startCirca = false;
        $this->end = null;
        $this->endCirca = false;
    }

    /**
     * Return a string representation.
     *
     * @return string
     */
    public function __toString() {
        if (($this->startCirca === $this->endCirca) && ($this->start === $this->end)) {
            return ($this->startCirca ? 'c' : '') . $this->start;
        }

        return ($this->startCirca ? 'c' : '') . $this->start .
                '-' .
                ($this->endCirca ? 'c' : '') . $this->end;
    }

    public function getValue() {
        return (string) $this;
    }

    public function setValue($value) {
        $this->value = $value;
        $value = strtolower(preg_replace('/\s*/', '', (string) $value));
        $matches = array();
        if (false === strpos($value, '-')) {
            // not a range
            if (preg_match(YEAR_RE, $value, $matches)) {
                $this->startCirca = ('c' === $matches[1]);
                $this->start = $matches[2];
                $this->endCirca = $this->startCirca;
                $this->end = $this->start;
            } else {
                throw new Exception("Malformed date:  '{$value}'");
            }

            return $this;
        }
        if ( ! preg_match(RANGE_RE, $value, $matches)) {
            throw new Exception("Malformed Date range '{$value}'");
        }

        $this->startCirca = ('c' === $matches[1]);
        $this->start = $matches[2];
        if (count($matches) > 3) {
            $this->endCirca = ('c' === $matches[3]);
            $this->end = $matches[4];
        }

        return $this;
    }

    public function isRange() {
        return
            ($this->startCirca !== $this->endCirca) ||
            ($this->start !== $this->end);
    }

    public function hasStart() {
        return null !== $this->start && '' !== $this->start;
    }

    /**
     * Get start.
     *
     * @param mixed $withCirca
     *
     * @return int
     */
    public function getStart($withCirca = true) {
        if ($withCirca && $this->startCirca) {
            return 'c' . $this->start;
        }

        return $this->start;
    }

    public function hasEnd() {
        return null !== $this->end && '' !== $this->end;
    }

    /**
     * Get end.
     *
     * @param mixed $withCirca
     *
     * @return int
     */
    public function getEnd($withCirca = true) {
        if ($withCirca && $this->endCirca) {
            return 'c' . $this->end;
        }

        return $this->end;
    }

    /**
     * Set start.
     *
     * @param int $start
     *
     * @return CircaDate
     */
    public function setStart($start) {
        $this->start = $start;

        return $this;
    }

    /**
     * Set startCirca.
     *
     * @param bool $startCirca
     *
     * @return CircaDate
     */
    public function setStartCirca($startCirca) {
        $this->startCirca = $startCirca;

        return $this;
    }

    /**
     * Get startCirca.
     *
     * @return bool
     */
    public function getStartCirca() {
        return $this->startCirca;
    }

    /**
     * Set end.
     *
     * @param int $end
     *
     * @return CircaDate
     */
    public function setEnd($end) {
        $this->end = $end;

        return $this;
    }

    /**
     * Set endCirca.
     *
     * @param bool $endCirca
     *
     * @return CircaDate
     */
    public function setEndCirca($endCirca) {
        $this->endCirca = $endCirca;

        return $this;
    }

    /**
     * Get endCirca.
     *
     * @return bool
     */
    public function getEndCirca() {
        return $this->endCirca;
    }
}