<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\Snils;

/***
 * Фабрика для создания объектов Snils::class
 * @template T as Snils
 */
class SnilsFactory extends AbstractFactory
{
    protected const REGEX = "/\D((\d{3}-\d{3}-\d{3}\s\d{2})|(\d{11}))\D/";
    public function __construct()
    {
        parent::__construct( Snils::class );
    }

    /***
     * Проверяет СНИЛС на валидность.
     * Строка должна состоять только из цифр.
     * @param string $number
     * @return bool
     */
    public function valid( string $number ):bool
    {
        $number = $this->modifyValue( $number );
        return strlen( $number ) === 11 &&
            intval( substr($number, -2) ) === $this->checkDigit( $number );
    }

    /**
     * Вычисляет контрольную цифру.
     * @param string $snils
     * @return int
     */
    protected function checkDigit( string $snils ):int
    {
        $sum = 0;
        for ($i = 0; $i < 9; $i++)
            $sum += intval( $snils[$i] ) * (9 - $i) ;
        return ( ($check = ($sum < 100) ? $sum : $sum % 101) === 100) ? 0 : $check;
    }

    /**
     * @inheritDoc
     */
    protected function getMatches(string $str): array
    {
        $matches = [];
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1] ?? [];
    }
}