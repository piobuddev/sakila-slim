<?php


namespace Sakila\Domain\Entity;

/**
 * City
 */
class City extends AbstractEntity
{
    /**
     * @var string
     */
    private $city;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $cityId;
    /**
     * @var \Sakila\Domain\Entity\Country
     */
    private $country;
    /**
     * @var int
     */
    private $countryId;

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return City
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get lastUpdate.
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set lastUpdate.
     *
     * @param \DateTime $lastUpdate
     *
     * @return City
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get cityId.
     *
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Get country.
     *
     * @return \Sakila\Domain\Entity\Country|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country.
     *
     * @param \Sakila\Domain\Entity\Country|null $country
     *
     * @return City
     */
    public function setCountry(\Sakila\Domain\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     *
     * @return \Sakila\Domain\Entity\City
     */
    public function setCountryId(int $countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }
}
