<?php declare(strict_types=1);

namespace Algo\StickPath;

use Algo\Contract\CommandInterface;
use Algo\StickPath\StickPath;
use Algo\Utils\Mapper;
use Assert\Assertion;

final class StickPathCommand implements CommandInterface
{
    public function run() : void
    {
        echo "Enter integers width and height :" . PHP_EOL;
        fscanf(STDIN, "%d %d", $width, $height);

        $stickPathGenerator = StickPath::from($width, $height);

        echo "Enter top labels :" . PHP_EOL;
        $topLabelsString = stream_get_line(STDIN, 1024 + 1, "\n");
        Assertion::notEmpty($topLabelsString, 'Empty line given.');

        $topLabels = Mapper::stringToArray((string)$topLabelsString);
        $topLabelsPosition = [];
        foreach ($topLabels as $key => $topLabel) {
            $topLabelsPosition[$topLabel] = $key;
        }

        $diagramBodyHeight = $stickPathGenerator->height() - 2;
        for ($i = 0; $i < $diagramBodyHeight; $i++) {
            echo "Enter lines content with (|  | or |--|) :" . PHP_EOL;
     
            $line = stream_get_line(STDIN, 1024 + 1, "\n");
            Assertion::string($line);
            Assertion::notEmpty($line);
            $connectorsInput = $this->stringToArrayWithNotEmpty($line);
            if (false === $this->connectorsValidate($connectorsInput)) {
                echo 'You line is not valide use |--| or |  | and not |--|--| .' . PHP_EOL;
                $i = $i -1;
                continue;
            }

            $currentConnectorPosition = 0;
            foreach ($connectorsInput as $index => $connectorInput) {
                if ($connectorInput === '--') {
                    foreach ($topLabelsPosition as $index => $topLabelPosition) {
                        if ($topLabelPosition === $currentConnectorPosition) {
                            $topLabelsPosition[$index] = $topLabelPosition + 1;
                        }

                        if ($topLabelPosition - 1 === $currentConnectorPosition) {
                            $topLabelsPosition[$index] = $topLabelPosition - 1;
                        }
                    }
                }
                $currentConnectorPosition += 1;
            }
        }

        echo "Enter bottom label :" . PHP_EOL;

        $line = stream_get_line(STDIN, 1024 + 1, "\n");
        Assertion::string($line);
        Assertion::notEmpty($line);
        $bottom = Mapper::stringToArray($line);

        foreach ($topLabelsPosition as $key => $element) {
            echo sprintf("%s%s", $key, $bottom[$element]) . PHP_EOL;
        }
    }

    /**
     * @return array<string>
     */
    private function stringToArrayWithNotEmpty(string $str) : array
    {
        return array_filter(
            explode("|", $str),
            function ($val) {
                return strlen($val) > 0;
            }
        );
    }

    /**
     * @param array<string> $connectorsInput
     */
    private function connectorsValidate(array $connectorsInput) : bool
    {
        $connectorsAuthorize = ['  ', '--'];

        foreach ($connectorsInput as $key => $connectorInput) {
            if (false === in_array($connectorInput, $connectorsAuthorize)) {
                return false;
            }

            // check if no |--|--|
            if (isset($connectorsInput[$key + 1]) && $connectorInput === '--' && $connectorsInput[$key + 1] == $connectorInput) {
                return false;
            }
        }
  
        return true;
    }
}
