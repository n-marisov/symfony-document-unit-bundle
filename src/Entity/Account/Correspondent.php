<?php

namespace Maris\Symfony\DocumentUnit\Entity\Account;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;

/***
 * Номер корреспондентского счета банка.
 */
#[Embeddable]
class Correspondent extends AbstractLegalNumber
{
    #[Column( name: "correspondent_account", length: 20,nullable: true)]
    protected string $value;
}