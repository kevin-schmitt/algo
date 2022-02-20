<?php declare(strict_types=1);

namespace Algo\StickPath;

use Assert\Assertion;

final class StickPath
{

    private int $width;
    private int $height;

    private function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @throw                    AssertionFailedException
     * @phpstan-ignore-next-line
     */
    public static function from($width, $height) : self
    {
        Assertion::numeric($width, 'height require numeric value.');
        Assertion::min($width, 4, "width minimal value is 4 given $width.");
        Assertion::numeric($height, "height require numeric value.");
        Assertion::min($height, 3, "height minimal value is 3 given $height.");
        Assertion::max($height, 100, "height max value is 100 given $height.");

        return new self((int)$width, (int)$height);
    }

    public function width() : int
    {
        return $this->width;
    }

    public function height() : int
    {
        return $this->height;
    }
}
