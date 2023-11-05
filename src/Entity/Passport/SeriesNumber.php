<?php

namespace Maris\Symfony\DocumentUnit\Entity\Passport;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Maris\Symfony\DocumentUnit\Entity\AbstractLegalNumber;

/***
 * Серия и номер паспорта.
 */
#[Embeddable]
class SeriesNumber extends AbstractLegalNumber
{
    /***
     * Серия и номер паспорта одной строкой.
     * @var string
     */
    #[Column(name: 'passport_series_and_number',length: '10',nullable: true)]
    protected string $value;
}