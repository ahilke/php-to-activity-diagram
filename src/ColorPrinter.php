<?php declare(strict_types=1);

namespace App;

final class ColorPrinter
{
    private const BLUE_ZODIAC = [19, 38, 77];
    private const BOTTLE_GREEN = [9, 54, 36];
    private const BACKGROUND_COLORS_RGB = [
        self::BLUE_ZODIAC,
        self::BOTTLE_GREEN,
    ];
    private const ESCAPE_START = "\e[";
    private const ESCAPE_END = 'm';
    private const RESET_COLOR = '0';

    private $counter = 0;

    private static function getAnsiBackgroundColorCode(array $color): string {
        return "48;2;{$color[0]};{$color[1]};{$color[2]}";
    }

    public function printWithAlternatingBackground(string $output): void {
        $colorIndex = $this->counter % count(self::BACKGROUND_COLORS_RGB);
        $backgroundColor = self::BACKGROUND_COLORS_RGB[$colorIndex];
        $this->counter += 1;

        echo self::ESCAPE_START;
        echo self::getAnsiBackgroundColorCode($backgroundColor);
        echo self::ESCAPE_END;

        echo $output;

        echo self::ESCAPE_START;
        echo self::RESET_COLOR;
        echo self::ESCAPE_END;
    }
}
