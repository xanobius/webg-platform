<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CssAttribute extends Enum
{
    const AnimationDuration = 0;
    const BackgroundColor = 1;
    const MarginLeft = 2;
    const MarginTop = 3;
}
