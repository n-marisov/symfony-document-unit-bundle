<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\Ogrn;

/***
 * @template T as Ogrn
 */
class OgrnFactory extends AbstractFactory
{
    protected const REGEX = "/\D(([15])\d{12}|3\d{14})\D/";
    public function __construct()
    {
        parent::__construct( Ogrn::class );
    }

    /***
     * Проверяет ИНН на валидность.
     * Строка должна состоять только из цифр.
     * @param string $number
     * @return bool
     */
    public function valid( string $number ):bool
    {
        return ctype_digit($number) && match (strlen($number)){
                13 => intval( $number[12] ) ===  $this->checkDigit( $number ),
                15 => intval( $number[14] ) ===  $this->checkDigit( $number ),
                default => false
        };
    }

    /**
     * Вычисляет контрольную цифру.
     * @param string $ogrn
     * @return int
     */
    protected function checkDigit( string $ogrn ):int
    {
        return intval(substr(bcsub(substr($ogrn, 0, -1), bcmul(bcdiv(substr($ogrn, 0, -1), strlen($ogrn) - 2), strlen($ogrn) - 2)), -1));
    }

    protected function getMatches(string $str): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1];
    }
}