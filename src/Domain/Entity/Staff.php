<?php


namespace Sakila\Domain\Entity;

/**
 * Staff
 */
class Staff extends AbstractEntity
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string|null
     */
    private $picture;
    /**
     * @var string|null
     */
    private $email;
    /**
     * @var int
     */
    private $active = 1;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string|null
     */
    private $password;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var bool
     */
    private $staffId;
    /**
     * @var \Sakila\Domain\Entity\Address
     */
    private $address;
    /**
     * @var int
     */
    private $addressId;
    /**
     * @var \Sakila\Domain\Entity\Store
     */
    private $store;
    /**
     * @var int
     */
    private $storeId;

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Staff
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Staff
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string|null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture.
     *
     * @param string|null $picture
     *
     * @return Staff
     */
    public function setPicture($picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Staff
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get active.
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active.
     *
     * @param int $active
     *
     * @return Staff
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Staff
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return Staff
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

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
     * @return Staff
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get staffId.
     *
     * @return bool
     */
    public function getStaffId()
    {
        return $this->staffId;
    }

    /**
     * Get address.
     *
     * @return \Sakila\Domain\Entity\Address|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param \Sakila\Domain\Entity\Address|null $address
     *
     * @return Staff
     */
    public function setAddress(\Sakila\Domain\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get store.
     *
     * @return \Sakila\Domain\Entity\Store|null
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set store.
     *
     * @param \Sakila\Domain\Entity\Store|null $store
     *
     * @return Staff
     */
    public function setStore(\Sakila\Domain\Entity\Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @return int
     */
    public function getAddressId(): int
    {
        return $this->addressId;
    }

    /**
     * @param int $addressId
     *
     * @return Staff
     */
    public function setAddressId(int $addressId): Staff
    {
        $this->addressId = $addressId;

        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->storeId;
    }

    /**
     * @param int $storeId
     *
     * @return Staff
     */
    public function setStoreId(int $storeId): Staff
    {
        $this->storeId = $storeId;

        return $this;
    }
}
