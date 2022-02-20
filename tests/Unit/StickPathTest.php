<?php declare(strict_types=1);

use Algo\StickPath\StickPath;
use PHPUnit\Framework\TestCase;

class StickPathTest extends TestCase
{
    /**
     * @test
     * @dataProvider stickPathParams
     */
    public function createStickPath(int $width, int $height, bool $exceptionExcepted) : void 
    {
        try {
            $stickPath = StickPath::from($width, $height);
            $this->assertEquals($width, $stickPath->width());
            $this->assertEquals($height, $stickPath->height());
        } catch(Throwable $e) {
            $this->assertTrue($exceptionExcepted, "Exception no handled");
        }
    }

    public function stickPathParams() : iterable
    {
        yield [4, 4, false];
        yield [3, 4, true];
        yield [4, 101, true];
    }
}