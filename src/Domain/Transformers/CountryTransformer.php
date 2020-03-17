<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Country;

class CountryTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Country $country
     *
     * @return array
     */
    public function transform(Country $country): array
    {
        return [
            'countryId' => $country->getCountryId(),
            'country'   => $country->getCountry(),
        ];
    }
}
