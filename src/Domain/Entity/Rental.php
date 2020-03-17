<?php


namespace Sakila\Domain\Entity;

/**
 * Rental
 */
class Rental extends AbstractEntity
{
    /**
     * @var \DateTime
     */
    private $rentalDate;
    /**
     * @var \DateTime|null
     */
    private $returnDate;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $rentalId;
    /**
     * @var \Sakila\Domain\Entity\Customer
     */
    private $customer;
    /**
     * @var int
     */
    private $customerId;
    /**
     * @var \Sakila\Domain\Entity\Inventory
     */
    private $inventory;
    /**
     * @var int
     */
    private $inventoryId;
    /**
     * @var \Sakila\Domain\Entity\Staff
     */
    private $staff;
    /**
     * @var int
     */
    private $staffId;

    public function getRentalDate(): string
    {
        return $this->rentalDate->format('Y-m-d H:i:s');
    }

    /**
     * Set rentalDate.
     *
     * @param \DateTime $rentalDate
     *
     * @return Rental
     */
    public function setRentalDate($rentalDate)
    {
        $this->rentalDate = $rentalDate;

        return $this;
    }

    public function getReturnDate(): ?string
    {
        return $this->returnDate ? $this->returnDate->format('Y-m-d H:i:s') : null;
    }

    /**
     * Set returnDate.
     *
     * @param \DateTime|null $returnDate
     *
     * @return Rental
     */
    public function setReturnDate($returnDate = null)
    {
        $this->returnDate = $returnDate;

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
     * @return Rental
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get rentalId.
     *
     * @return int
     */
    public function getRentalId()
    {
        return $this->rentalId;
    }

    /**
     * Get customer.
     *
     * @return \Sakila\Domain\Entity\Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set customer.
     *
     * @param \Sakila\Domain\Entity\Customer|null $customer
     *
     * @return Rental
     */
    public function setCustomer(\Sakila\Domain\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get inventory.
     *
     * @return \Sakila\Domain\Entity\Inventory|null
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Set inventory.
     *
     * @param \Sakila\Domain\Entity\Inventory|null $inventory
     *
     * @return Rental
     */
    public function setInventory(\Sakila\Domain\Entity\Inventory $inventory = null)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Get staff.
     *
     * @return \Sakila\Domain\Entity\Staff|null
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set staff.
     *
     * @param \Sakila\Domain\Entity\Staff|null $staff
     *
     * @return Rental
     */
    public function setStaff(\Sakila\Domain\Entity\Staff $staff = null)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * @return int
     */
    public function getInventoryId(): int
    {
        return $this->inventoryId;
    }

    /**
     * @param int $inventoryId
     *
     * @return \Sakila\Domain\Entity\Rental
     */
    public function setInventoryId(int $inventoryId): Rental
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     *
     * @return Rental
     */
    public function setCustomerId(int $customerId): Rental
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getStaffId(): int
    {
        return $this->staffId;
    }

    /**
     * @param int $staffId
     *
     * @return Rental
     */
    public function setStaffId(int $staffId): Rental
    {
        $this->staffId = $staffId;

        return $this;
    }
}
