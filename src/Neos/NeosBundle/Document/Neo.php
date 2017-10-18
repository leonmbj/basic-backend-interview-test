<?php
namespace Neos\NeosBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document(repositoryClass="Neos\NeosBundle\Repository\NeoRepository")
 */
class Neo
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $date;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $reference;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $speed;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $is_hazardous;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get reference
     *
     * @return integer $reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set speed
     *
     * @param float $speed
     * @return $this
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * Get speed
     *
     * @return float $speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set isHazardous
     *
     * @param boolean $isHazardous
     * @return $this
     */
    public function setIsHazardous($isHazardous)
    {
        $this->is_hazardous = $isHazardous;
        return $this;
    }

    /**
     * Get isHazardous
     *
     * @return boolean $isHazardous
     */
    public function getIsHazardous()
    {
        return $this->is_hazardous;
    }

    /**
    *   Get fastest object
    *
    *   @return object
    */
    public function fetchFastestObject($hazardous)
    {

    }
}
