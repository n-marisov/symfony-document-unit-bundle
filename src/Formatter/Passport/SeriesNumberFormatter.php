<?php

namespace Maris\Symfony\DocumentUnit\Formatter\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\SeriesNumber;

/***
 * Форматирует серию и номер паспорта как в документе.
 */
class SeriesNumberFormatter
{
    public function format( SeriesNumber $seriesNumber ):string
    {
        $seriesNumber = (string) $seriesNumber;
        return implode(" ",[
            substr($seriesNumber,0,2),
            substr($seriesNumber,2,2),
            substr($seriesNumber,4,6)
        ]);
    }
}