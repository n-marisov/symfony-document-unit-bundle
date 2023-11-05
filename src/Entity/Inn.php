<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Stringable;

/**
 * Модель ИНН.
 * Сущность с закрытым конструктором, создается через фабрики.
 * Служит для однозначной валидации ИНН.
 * Если объект создан без ошибок значит ИНН валидный.
 */
#[Embeddable]
class Inn extends AbstractLegalNumber
{
    /***
     * Значение ИНН хранится как строка.
     * @var string
     */
    #[Column( name: 'inn', length: '12', nullable: true )]
    protected string $value;
}