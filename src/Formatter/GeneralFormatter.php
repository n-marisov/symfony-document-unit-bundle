<?php

namespace Maris\Symfony\DocumentUnit\Formatter;

use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;
use Maris\Symfony\DocumentUnit\Entity\Passport\DivisionCode;
use Maris\Symfony\DocumentUnit\Entity\Passport\SeriesNumber;
use Maris\Symfony\DocumentUnit\Entity\Snils;
use Maris\Symfony\DocumentUnit\Formatter\Passport\DivisionCodeFormatter;
use Maris\Symfony\DocumentUnit\Formatter\Passport\SeriesNumberFormatter;

/***
 * Главный форматер способный форматировать все модели.
 */
class GeneralFormatter
{
    protected SnilsFormatter $snilsFormatter;
    protected DivisionCodeFormatter $divisionCodeFormatter;
    protected SeriesNumberFormatter $seriesNumberFormatter;

    /**
     * @param SnilsFormatter $snilsFormatter
     * @param DivisionCodeFormatter $divisionCodeFormatter
     * @param SeriesNumberFormatter $seriesNumberFormatter
     */
    public function __construct(SnilsFormatter $snilsFormatter, DivisionCodeFormatter $divisionCodeFormatter, SeriesNumberFormatter $seriesNumberFormatter)
    {
        $this->snilsFormatter = $snilsFormatter;
        $this->divisionCodeFormatter = $divisionCodeFormatter;
        $this->seriesNumberFormatter = $seriesNumberFormatter;
    }


    public function format( AbstractLegalNumber $number ):string
    {
        return match (true) {
            is_a($number,Snils::class) => $this->snilsFormatter->format( $number ),
            is_a($number,DivisionCode::class) => $this->divisionCodeFormatter->format( $number ),
            is_a($number,SeriesNumber::class) => $this->seriesNumberFormatter->format( $number ),
            default => (string) $number
        };
    }
}