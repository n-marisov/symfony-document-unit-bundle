<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Stringable;

/***
 * Абстрактный класс для всех видов номеров.
 * Любой номер является строкой.
 */
#[MappedSuperclass]
abstract class AbstractLegalNumber implements Stringable
{
    /***
     * Значение без лишних символов.
     * @var string
     */
    protected string $value;

    /**
     * Закрытый конструктор.
     * Все экземпляры создаются через фабрики.
     */
    protected function __construct(){}


    /***
     * Привидение к строке по умолчанию.
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

}