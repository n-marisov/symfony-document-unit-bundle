<?php

namespace Maris\Symfony\DocumentUnit\Factory;

use Maris\Symfony\DocumentUnit\Entity\Bik;

/**
 * Фабрика для создания объектов Bik::class (БИК).
 * @template T as Bik
 */
class BikFactory extends AbstractFactory
{
    protected const REGEX = "/\D([012]\d{8})\D/";

    public function __construct()
    {
        parent::__construct(Bik::class);
    }

    /***
     * @inheritDoc
     */
    public function valid( string $number ):bool
    {
        return preg_match(self::REGEX, " $number ");
    }

    /***
     * @inheritDoc
     */
    protected function getMatches( string $str ): array
    {
        preg_match_all(self::REGEX," $str ",$matches );
        return $matches[1] ?? [];
    }
}