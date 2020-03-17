<?php declare(strict_types=1);


namespace Sakila\Application\Fractal;

use ArrayIterator;
use IteratorAggregate;
use League\Fractal\Pagination\PaginatorInterface;
use Traversable;

class SimplePaginator implements PaginatorInterface, IteratorAggregate
{
    /**
     * @var array
     */
    private array $items;

    /**
     * @var int
     */
    private int $page;

    /**
     * @var int
     */
    private int $pageSize;

    /**
     * @var int
     */
    private int $total;

    public function __construct(array $items, int $page, int $pageSize, int $total)
    {
        $this->items    = $items;
        $this->page     = $page;
        $this->pageSize = $pageSize;
        $this->total    = $total;
    }

    /**
     * Get the current page.
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->page;
    }

    /**
     * Get the last page.
     *
     * @return int
     */
    public function getLastPage()
    {
        return (int)ceil($this->total / $this->pageSize);
    }

    /**
     * Get the total.
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the count.
     *
     * @return int
     */
    public function getCount()
    {
        return count($this->items);
    }

    /**
     * Get the number per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->pageSize;
    }

    /**
     * Get the url for the given page.
     *
     * @param int $page
     *
     * @return string
     */
    public function getUrl($page)
    {
        return '';
    }

    /**
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}
