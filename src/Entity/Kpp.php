<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Stringable;

/***
 * Модель КПП.
 * Служит для однозначной валидации КПП.
 * Если объект создан без ошибок значит КПП валидный.
 */
#[Embeddable]
class Kpp extends AbstractLegalNumber
{
    #[Column(name: 'kpp', length: '9',nullable: true)]
    protected string $value;
}