<?php

namespace Maris\Symfony\DocumentUnit\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use RuntimeException;
use Stringable;

/***
 * СНИЛС.
 */
#[Embeddable]
class Snils extends AbstractLegalNumber
{
    #[Column( name: "snils", length: 11)]
    protected string $value;
}