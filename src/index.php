
#!/usr/bin/php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Algo\StickPath\StickPathCommand;

try {
    (new StickPathCommand)->run();
} catch (Throwable $e) {
    echo sprintf('Error: %s', $e->getMessage()) . PHP_EOL;
}
