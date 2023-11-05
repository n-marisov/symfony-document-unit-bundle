<?php

namespace Maris\Symfony\DocumentUnit\Factory\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\SeriesNumber;
use Maris\Symfony\DocumentUnit\Factory\AbstractFactory;

/***
 * Фабрика для создания серии и номера паспорта.
 */
class SeriesNumberFactory extends AbstractFactory
{
    protected const REGEX = "/\D(\d{2}\s?\d{2}\s?\d{6})\D/";
    /***
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct(SeriesNumber::class);
    }

    /***
     * @inheritDoc
     */
    public function valid( string $number ):bool
    {
        return preg_match(self::REGEX , " $number ");
    }

    /***
     * @inheritDoc
     */
    protected function getMatches(string $str): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1] ?? [];
    }
}