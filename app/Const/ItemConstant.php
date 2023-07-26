<?php

namespace App\Const;

class ItemConstant
{
    const HP = 'HP',
    ATK = 'ATK',
    DEF = 'DEF',
    CRIT_RATE = 'CRIT_RATE',
    CRIT_DMG = 'CRIT_DMG',
    SPD = 'SPD';

    const GEM_TYPES = [
        self::HP,
        self::ATK,
        self::DEF,
        self::CRIT_RATE,
        self::CRIT_DMG,
        self::SPD,
    ];
}
