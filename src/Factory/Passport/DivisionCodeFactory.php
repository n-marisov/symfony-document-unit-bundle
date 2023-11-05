<?php

namespace Maris\Symfony\DocumentUnit\Factory\Passport;

use Maris\Symfony\DocumentUnit\Entity\Passport\DivisionCode;
use Maris\Symfony\DocumentUnit\Factory\AbstractFactory;

/**
 * Фабрика для создания кода подразделения паспорта.
 */
class DivisionCodeFactory extends AbstractFactory
{
    protected const REGEX = "/[^\d-](\d{2}[0-3]\s?-?\s?\d{3})[^\d-]/";
    /***
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct(DivisionCode::class);
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