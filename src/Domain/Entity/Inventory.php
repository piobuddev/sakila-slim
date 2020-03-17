<?php


namespace Sakila\Domain\Entity;

/**
 * Inventory
 */
class Inventory extends AbstractEntity
{
    /**
     * @var \DateTime
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';
    /**
     * @var int
     */
    private $inventoryId;
    /**
     * @var \Sakila\Domain\Entity\Film
     */
    private $film;
    /**
     * @var int
     */
    private $filmId;
    /**
     * @var \Sakila\Domain\Entity\Store
     */
    private $store;
    /**
     * @var int
     */
    private $storeId;

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
     * @return Inventory
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get inventoryId.
     *
     * @return int
     */
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * Get film.
     *
     * @return \Sakila\Domain\Entity\Film|null
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set film.
     *
     * @param \Sakila\Domain\Entity\Film|null $film
     *
     * @return Inventory
     */
    public function setFilm(\Sakila\Domain\Entity\Film $film = null)
    {
        $this->film = $film;

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
     * @return Inventory
     */
    public function setStore(\Sakila\Domain\Entity\Store $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @return int
     */
    public function getFilmId(): int
    {
        return $this->filmId;
    }

    /**
     * @param int $filmId
     *
     * @return Inventory
     */
    public function setFilmId(int $filmId): Inventory
    {
        $this->filmId = $filmId;

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
     * @return Inventory
     */
    public function setStoreId(int $storeId): Inventory
    {
        $this->storeId = $storeId;

        return $this;
    }
}
