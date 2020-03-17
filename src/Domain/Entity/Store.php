<?php declare(strict_types=1);


namespace Sakila\Domain\Entity;

use DateTime;

class Store extends AbstractEntity
{
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $storeId;
    /**
     * @var \Sakila\Domain\Entity\Address
     */
    private $address;
    /**
     * @var int
     */
    private $addressId;
    /**
     * @var \Sakila\Domain\Entity\Staff
     */
    private $managerStaff;
    /**
     * @var int
     */
    private $managerStaffId;

    /**
     * Get lastUpdate.
     *
     * @return \DateTime
     */
    public function getLastUpdate(): DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * Set lastUpdate.
     *
     * @param \DateTime $lastUpdate
     *
     * @return Store
     */
    public function setLastUpdate($lastUpdate): Store
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get storeId.
     *
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->storeId;
    }

    /**
     * Get address.
     *
     * @return \Sakila\Domain\Entity\Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set address.
     *
     * @param \Sakila\Domain\Entity\Address|null $address
     *
     * @return Store
     */
    public function setAddress(Address $address = null): Store
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get managerStaff.
     *
     * @return \Sakila\Domain\Entity\Staff|null
     */
    public function getManagerStaff(): ?Staff
    {
        return $this->managerStaff;
    }

    /**
     * Set managerStaff.
     *
     * @param \Sakila\Domain\Entity\Staff|null $managerStaff
     *
     * @return Store
     */
    public function setManagerStaff(Staff $managerStaff = null): Store
    {
        $this->managerStaff = $managerStaff;

        return $this;
    }

    /**
     * @return int
     */
    public function getManagerStaffId(): int
    {
        return $this->managerStaffId;
    }

    /**
     * @param int $managerStaffId
     *
     * @return \Sakila\Domain\Entity\Store
     */
    public function setManagerStaffId(int $managerStaffId): Store
    {
        $this->managerStaffId = $managerStaffId;

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
     * @return Store
     */
    public function setAddressId(int $addressId): Store
    {
        $this->addressId = $addressId;

        return $this;
    }
}
