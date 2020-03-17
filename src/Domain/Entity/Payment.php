<?php


namespace Sakila\Domain\Entity;

/**
 * Payment
 */
class Payment extends AbstractEntity
{
    /**
     * @var string
     */
    private $amount;
    /**
     * @var \DateTime
     */
    private $paymentDate;
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $paymentId;
    /**
     * @var \Sakila\Domain\Entity\Customer
     */
    private $customer;
    /**
     * @var int
     */
    private $customerId;
    /**
     * @var \Sakila\Domain\Entity\Rental
     */
    private $rental;
    /**
     * @var int
     */
    private $rentalId;
    /**
     * @var \Sakila\Domain\Entity\Staff
     */
    private $staff;
    /**
     * @var int
     */
    private $staffId;

    /**
     * Get amount.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set amount.
     *
     * @param string $amount
     *
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate->format('Y-m-d H:i:s');
    }

    /**
     * Set paymentDate.
     *
     * @param \DateTime $paymentDate
     *
     * @return Payment
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

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
     * @return Payment
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get paymentId.
     *
     * @return int
     */
    public function getPaymentId()
    {
        return $this->paymentId;
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
     * @return Payment
     */
    public function setCustomer(\Sakila\Domain\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get rental.
     *
     * @return \Sakila\Domain\Entity\Rental|null
     */
    public function getRental()
    {
        return $this->rental;
    }

    /**
     * Set rental.
     *
     * @param \Sakila\Domain\Entity\Rental|null $rental
     *
     * @return Payment
     */
    public function setRental(\Sakila\Domain\Entity\Rental $rental = null)
    {
        $this->rental = $rental;

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
     * @return Payment
     */
    public function setStaff(\Sakila\Domain\Entity\Staff $staff = null)
    {
        $this->staff = $staff;

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
     * @return Payment
     */
    public function setCustomerId(int $customerId): Payment
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
     * @return Payment
     */
    public function setStaffId(int $staffId): Payment
    {
        $this->staffId = $staffId;

        return $this;
    }

    /**
     * @return int
     */
    public function getRentalId(): int
    {
        return $this->rentalId;
    }

    /**
     * @param int $rentalId
     *
     * @return Payment
     */
    public function setRentalId(int $rentalId): Payment
    {
        $this->rentalId = $rentalId;

        return $this;
    }
}
