<?php

namespace Maris\Symfony\DocumentUnit\Entity\Passport;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;

/***
 * Код подразделения в паспорте.
 */
#[Embeddable]
class DivisionCode extends AbstractLegalNumber
{
    #[Column( name: "passport_division_code", length: 6)]
    protected string $value;
}