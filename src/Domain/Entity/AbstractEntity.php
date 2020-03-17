<?php declare(strict_types=1);


namespace Sakila\Domain\Entity;

use Sakila\Entity\EntityInterface;
use Sakila\Utils\StringUtil;

class AbstractEntity implements EntityInterface
{
    /**
     * @param array $data
     *
     * @return \Sakila\Entity\EntityInterface
     */
    public function fill(array $data)
    {
        foreach ($data as $field => $value) {
            $method = 'set' . StringUtil::toCamelCase($field, '_', true);
            if (method_exists($this, $method)) {
                call_user_func([get_class($this), $method], $value);
                continue;
            }

            $property = StringUtil::toCamelCase($field);
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}
