<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Stringable;

/***
 * Модель ОРГН или ОГРНИП.
 * Сущность с закрытым конструктором, создается через фабрики.
 * Служит для однозначной валидации ОРГН.
 * Если объект создан без ошибок значит ОРГН валидный.
 */
#[Embeddable]
class Ogrn extends AbstractLegalNumber
{
    /***
     * Значение ОГРН хранится как строка.
     * @var string
     */
    #[Column(name: 'ogrn', length: '15',nullable: true)]
    protected string $value;
}