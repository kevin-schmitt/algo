<?php declare(strict_types=1);

namespace Algo\Contract;

interface CommandInterface
{
    public function run() : void;
}
