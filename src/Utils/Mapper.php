<?php declare(strict_types=1);

namespace Algo\Utils;

use Assert\Assertion;

class Mapper
{
    /**
     * @return array<string>
     */
    public static function stringToArray(string $value) : array
    {
        Assertion::notEmpty($value, 'Empty value not authorize, given ' . $value);
        $value = (string)preg_replace("/\s+/", "", $value);
        $listElements = str_split($value);
        Assertion::isArray($listElements);

        return $listElements;
    }
}
