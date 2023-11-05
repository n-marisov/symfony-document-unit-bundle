<?php

namespace Maris\Symfony\DocumentUnit\Informer\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\DivisionCode;

/***
 * Возвращает различную информацию о коде подразделения выдачи паспорта.
 */
class DivisionCodeInformer
{
    /**
     * Получает код региона в котором выдан паспорт.
     * @param DivisionCode $code
     * @return string
     */
    public function getRegionCode( DivisionCode $code ):string
    {
        return substr( $code,0,2 );
    }

    /**
     * Возвращает тип подразделения в котором выдан паспорт.
     * @param DivisionCode $code
     * @return string
     */
    public function getDivisionType( DivisionCode $code ):string
    {
        return match (intval( $code[2] )){
            0 => "УФМС",
            1 => "УВД / МВД / ГУВД",
            2 => "в районном или городском ОВД",
            3 => "в паспортно-визовой службе городского, сельского или поселкового формата"
        };
    }
}