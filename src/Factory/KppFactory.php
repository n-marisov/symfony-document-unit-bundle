<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\Kpp;


class KppFactory extends AbstractFactory
{
    protected const REGEX = "/\D(\d{4}[\dA-Z]{2}\d{3})\D/";

    public function __construct()
    {
        parent::__construct(Kpp::class );
    }


    /***
     * Проверяет ИНН на валидность.
     * Строка должна состоять только из цифр.
     * @param string $number
     * @return bool
     */
    public function valid( string $number ):bool
    {
        return preg_match(self::REGEX, " $number ");
    }

    protected function getMatches(string $str): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1];
    }
}