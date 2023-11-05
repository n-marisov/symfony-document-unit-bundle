<?php

namespace Maris\Symfony\DocumentUnit\Formatter\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\DivisionCode;
use function Symfony\Component\String\s;

/***
 * Форматирует код подразделения выдачи паспорта как в документе.
 */
class DivisionCodeFormatter
{
    public function format( DivisionCode $code ):string
    {
        $code = (string) $code;
        return implode("-",[
            substr( $code,0,3),
            substr( $code,3,3)
        ]);
    }
}