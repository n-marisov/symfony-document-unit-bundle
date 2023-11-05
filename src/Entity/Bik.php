<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Stringable;

/***
 * Модель БИК.
 * Служит для однозначной валидации БИК.
 * Если объект создан без ошибок значит БИК валидный.
 */
#[Embeddable]
class Bik extends AbstractLegalNumber
{
    #[Column( name: "bik", length: 9, nullable: true)]
    protected string $value;
}