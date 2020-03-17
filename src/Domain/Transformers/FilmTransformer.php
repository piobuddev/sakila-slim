<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Film;

class FilmTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'actors',
        'categories',
    ];

    /**
     * @param \Sakila\Domain\Entity\Film $film
     *
     * @return array
     */
    public function transform(Film $film): array
    {
        return [
            'filmId'             => $film->getFilmId(),
            'title'              => $film->getTitle(),
            'description'        => $film->getDescription(),
            'releaseYear'        => $film->getReleaseYear(),
            'languageId'         => $film->getLanguageId(),
            'originalLanguageId' => $film->getOriginalLanguageId(),
            'rentalDuration'     => $film->getRentalDuration(),
            'rentalRate'         => $film->getRentalRate(),
            'length'             => $film->getLength(),
            'replacementCost'    => $film->getReplacementCost(),
            'rating'             => $film->getRating(),
            'specialFeatures'    => $film->getSpecialFeatures(),
        ];
    }

    /**
     * @param \Sakila\Domain\Entity\Film $film
     *
     * @return \League\Fractal\Resource\Collection
     */
    protected function includeActors(Film $film): Collection
    {
        return $this->collection($film->getActor(), new ActorTransformer());
    }

    /**
     * @param \Sakila\Domain\Entity\Film $film
     *
     * @return \League\Fractal\Resource\Collection
     */
    protected function includeCategories(Film $film): Collection
    {
        return $this->collection($film->getCategory(), new CategoryTransformer());
    }
}
