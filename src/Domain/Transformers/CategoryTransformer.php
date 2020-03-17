<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Category $category
     *
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'categoryId' => $category->getCategoryId(),
            'name'       => $category->getName(),
        ];
    }
}
