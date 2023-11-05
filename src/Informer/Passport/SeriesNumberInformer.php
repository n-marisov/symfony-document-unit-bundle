<?php

namespace Maris\Symfony\DocumentUnit\Informer\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\SeriesNumber;

/***
 * Возвращает информацию о серии и номере паспорта.
 */
class SeriesNumberInformer
{
    /**
     * Серия паспорта одной строкой.
     * @param SeriesNumber $seriesNumber
     * @return string
     */
    public function getSeries( SeriesNumber $seriesNumber ):string
    {
        return substr( $seriesNumber,0,4);
    }

    /**
     * Номер паспорта одной строкой.
     * @param SeriesNumber $seriesNumber
     * @return string
     */
    public function getNumber(  SeriesNumber $seriesNumber ):string
    {
        return substr( $seriesNumber,4,6);
    }

    /**
     * Код ОКАТО региона, в котором выдан паспорт.
     * @param SeriesNumber $seriesNumber
     * @return string
     */
    public function getRegionOkato(SeriesNumber $seriesNumber ):string
    {
        return substr( $seriesNumber,0,2);
    }

    /**
     * Третья и четвёртая цифры серии паспорта.
     * Соответствуют последним двум цифрам года
     * выпуска бланка паспорта (возможны отклонение на 1-3 года)
     * @param SeriesNumber $seriesNumber
     * @return string
     */
    public function getYearRelease(  SeriesNumber $seriesNumber  ):string
    {
        return substr( $seriesNumber,2,2 );
    }
}