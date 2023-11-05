<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\Inn;

/***
 * Фабрика для создания объектов ИНН.
 * @template T as Inn
 */
class InnFactory extends AbstractFactory
{

    protected const REGEX = "/\D(\d{10}|\d{12})\D/";

    public function __construct()
    {
        parent::__construct(Inn::class);
    }

    /***
     * Проверяет ИНН на валидность.
     * Строка должна состоять только из цифр.
     * @param string $number
     * @return bool
     */
    public function valid( string $number ):bool
    {
        return ctype_digit($number) && match ( strlen($number) ){
            10 => intval( $number[9] ) === $this->checkDigit10($number),
            12 => intval( $number[10] ) === $this->checkDigit11($number) &&
                  intval( $number[11] ) === $this->checkDigit12($number),
           default => false
        };
    }

    protected function checkDigit10( string $inn ):int
    {
        $sum = 0;
        foreach ([2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight)
            $sum += $weight * $inn[$i];
        return $sum % 11 % 10;
    }
    protected function checkDigit11( string $inn ):int
    {
        $sum = 0;
        foreach ([7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight)
        {
            $sum += $weight * $inn[$i];
        }
        return $sum % 11 % 10;
    }
    protected function checkDigit12( string $inn ):int
    {
        $sum = 0;
        foreach ([3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight)
        {
            $sum += $weight * $inn[$i];
        }
        return $sum % 11 % 10;
    }

    protected function getMatches(string $str): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1];
    }
}