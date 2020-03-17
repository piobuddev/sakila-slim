<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Language;

class LanguageTransformer extends TransformerAbstract
{
    public function transform(Language $language): array
    {
        return [
            'languageId' => $language->getLanguageId(),
            'name'       => $language->getName(),
        ];
    }
}
