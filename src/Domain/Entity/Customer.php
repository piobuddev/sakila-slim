<?php


namespace Sakila\Domain\Entity;

/**
 * Customer
 */
class Customer extends AbstractEntity
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
    private $email;
    /**
     * @var int
     */
    private $active = 1;
    /**
     * @var \DateTime
     */
    private $createDate;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $customerId;
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
     * @return Customer
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
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

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
     * @return Customer
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
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * Set active.
     *
     * @param int $active
     *
     * @return Customer
     */
    public function setActive(int $active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get createDate.
     *
     * @return string
     */
    public function getCreateDate(): string
    {
        return $this->createDate->format('Y-m-d H:i:s');
    }

    /**
     * Set createDate.
     *
     * @param \DateTime $createDate
     *
     * @return Customer
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

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
     * @return Customer
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get customerId.
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
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
     * @return Customer
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
     * @return Customer
     */
    public function setStore(\Sakila\Domain\Entity\Store $store = null)
    {
        $this->store = $store;

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
     * @return Customer
     */
    public function setStoreId(int $storeId): Customer
    {
        $this->storeId = $storeId;

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
     * @return Customer
     */
    public function setAddressId(int $addressId): Customer
    {
        $this->addressId = $addressId;

        return $this;
    }
}
