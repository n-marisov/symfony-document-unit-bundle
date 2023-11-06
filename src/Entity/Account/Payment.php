<?php

namespace Maris\Symfony\DocumentUnit\Entity\Account;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;


/***
 * Номер банковского счета.
 */
#[Embeddable]
class Payment extends AbstractLegalNumber
{
    #[Column( name: "payment_account", length: 20)]
    protected string $value;
}