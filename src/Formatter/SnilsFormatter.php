<?php

namespace Maris\Symfony\DocumentUnit\Formatter;

use Maris\Symfony\DocumentUnit\Entity\Snils;

/**
 * Форматирует объект Snils как в документе.
 */
class SnilsFormatter
{
    /**
     * Форматирует СНИЛС как в документе.
     * @param Snils $snils
     * @return string
     */
    public function format( Snils $snils ):string
    {
        $snils = (string) $snils;
        return implode(" ",[
            implode("-",[
                substr($snils,0,3),
                substr($snils,3,3),
                substr($snils,6,3)
            ]),
            substr($snils,9,2)
        ]);
    }
}