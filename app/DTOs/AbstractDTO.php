<?php

namespace App\DTOs;

use stdClass;

abstract class AbstractDTO
{
    /**
     * AbstractDTO constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Convert DTO to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->toString(), true);
    }

    /**
     * Convert DTO to an JSON.
     *
     * @return stdClass
     */
    public function toJson(): stdClass
    {
        return json_decode($this->toString());
    }

    /**
     * Convert DTO to a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return json_encode($this);
    }
}
