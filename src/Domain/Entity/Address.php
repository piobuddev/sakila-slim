<?php declare(strict_types=1);


namespace Sakila\Domain\Entity;

/**
 * Address
 */
class Address extends AbstractEntity
{
    /**
     * @var string
     */
    private $address;
    /**
     * @var string|null
     */
    private $address2;
    /**
     * @var string
     */
    private $district;
    /**
     * @var string|null
     */
    private $postalCode;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $addressId;
    /**
     * @var \Sakila\Domain\Entity\City
     */
    private $city;
    /**
     * @var int
     */
    private $cityId;

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address2.
     *
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address2.
     *
     * @param string|null $address2
     *
     * @return Address
     */
    public function setAddress2($address2 = null)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get district.
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set district.
     *
     * @param string $district
     *
     * @return Address
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get postalCode.
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set postalCode.
     *
     * @param string|null $postalCode
     *
     * @return Address
     */
    public function setPostalCode($postalCode = null)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Address
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * @return Address
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get addressId.
     *
     * @return int
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * Get city.
     *
     * @return \Sakila\Domain\Entity\City|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city.
     *
     * @param \Sakila\Domain\Entity\City|null $city
     *
     * @return Address
     */
    public function setCity(\Sakila\Domain\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     *
     * @return \Sakila\Domain\Entity\Address
     */
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }
}
