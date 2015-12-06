<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connections
 *
 * @ORM\Table(name="connections")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConnectionsRepository")
 */
class Connections
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
     * @var string
     *
     * @ORM\Column(name="port", type="string", length=255, nullable=true)
     */
    private $port;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=true)
     */
    private $dateTime;

    /**
     * @var int
     *
     * @ORM\Column(name="unitId", type="integer", nullable=true)
     */
    private $unitId;


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
     * Set port
     *
     * @param string $port
     *
     * @return Connections
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Connections
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Connections
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
     * Set unitId
     *
     * @param integer $unitId
     *
     * @return Connections
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
}

