<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Positions
 *
 * @ORM\Table(name="positions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PositionsRepository")
 */
class Positions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="unitId", type="integer", nullable=true)
     */
    private $unitId;

    /**
     * @var string
     *
     * @ORM\Column(name="rDx", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $rDx;

    /**
     * @var string
     *
     * @ORM\Column(name="rDy", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $rDy;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $speed;

    /**
     * @var string
     *
     * @ORM\Column(name="course", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $course;

    /**
     * @var int
     *
     * @ORM\Column(name="numSattellites", type="integer", nullable=true)
     */
    private $numSattellites;

    /**
     * @var int
     *
     * @ORM\Column(name="hdop", type="integer")
     */
    private $hdop;

    /**
     * @var string
     *
     * @ORM\Column(name="quality", type="string", length=255)
     */
    private $quality;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=true)
     */
    private $dateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set unitId
     *
     * @param integer $unitId
     *
     * @return Positions
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;

        return $this;
    }

    /**
     * Get unitId
     *
     * @return int
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * Set rDx
     *
     * @param string $rDx
     *
     * @return Positions
     */
    public function setRDx($rDx)
    {
        $this->rDx = $rDx;

        return $this;
    }

    /**
     * Get rDx
     *
     * @return string
     */
    public function getRDx()
    {
        return $this->rDx;
    }

    /**
     * Set rDy
     *
     * @param string $rDy
     *
     * @return Positions
     */
    public function setRDy($rDy)
    {
        $this->rDy = $rDy;

        return $this;
    }

    /**
     * Get rDy
     *
     * @return string
     */
    public function getRDy()
    {
        return $this->rDy;
    }

    /**
     * Set speed
     *
     * @param string $speed
     *
     * @return Positions
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set course
     *
     * @param string $course
     *
     * @return Positions
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set numSattellites
     *
     * @param integer $numSattellites
     *
     * @return Positions
     */
    public function setNumSattellites($numSattellites)
    {
        $this->numSattellites = $numSattellites;

        return $this;
    }

    /**
     * Get numSattellites
     *
     * @return int
     */
    public function getNumSattellites()
    {
        return $this->numSattellites;
    }

    /**
     * Set hdop
     *
     * @param integer $hdop
     *
     * @return Positions
     */
    public function setHdop($hdop)
    {
        $this->hdop = $hdop;

        return $this;
    }

    /**
     * Get hdop
     *
     * @return int
     */
    public function getHdop()
    {
        return $this->hdop;
    }

    /**
     * Set quality
     *
     * @param string $quality
     *
     * @return Positions
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality
     *
     * @return string
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Positions
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Positions
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Positions
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

