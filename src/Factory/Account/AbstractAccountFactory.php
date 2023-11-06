<?php

namespace Maris\Symfony\DocumentUnit\Factory\Account;

use Maris\Symfony\DocumentUnit\Entity\Account\Correspondent;
use Maris\Symfony\DocumentUnit\Entity\Account\Payment;
use Maris\Symfony\DocumentUnit\Entity\Bik;
use Maris\Symfony\DocumentUnit\Factory\AbstractFactory;
use ReflectionException;

abstract class AbstractAccountFactory extends AbstractFactory
{
    protected const REGEX = "/\D(\d{5}\s?\.?\s?\d{3}\s?\.?\s?\d\s?\.?\s?\d{11})\D/";

    protected ?Bik $bikDefault = null;


    /**
     * @return Bik|null
     */
    public function getBikDefault(): ?Bik
    {
        return $this->bikDefault;
    }

    /**
     * @param Bik|null $bikDefault
     * @return $this
     */
    public function setBikDefault(?Bik $bikDefault): self
    {
        $this->bikDefault = $bikDefault;
        return $this;
    }




    protected function getMatches(string $str): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1];
    }

    /***
     * Принимает БИК банка в котором зарегистрирован счет и номер счета.
     * @param string $number
     * @return bool
     */
    public function valid( string $number ): bool
    {


        $number = $this->modifyValue( $number );
        return strlen( $number ) === 20 && 0 === $this->checkDigit( $number );
    }

    /**
     * Вычисляет контрольную сумму.
     * @param string $number
     * @return int
     */
    protected function checkDigit( string $number ):int
    {
        $check = 0;
        $number = $this->checkDigitStart( $number );
        foreach ([7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1] as $i => $k)
            $check += $k * ((int) $number[$i] % 10);
        return $check % 10 ;
    }

    /**
     * Формирует начальные данные для расчета контрольной суммы
     * @param string $number
     * @return string
     */
    abstract protected function checkDigitStart( string $number ):string;
}