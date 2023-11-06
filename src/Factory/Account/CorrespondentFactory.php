<?php

namespace Maris\Symfony\DocumentUnit\Factory\Account;

use Maris\Symfony\DocumentUnit\Entity\Account\Correspondent;
use Maris\Symfony\DocumentUnit\Entity\Bik;


class CorrespondentFactory extends AbstractAccountFactory
{
    public function __construct( Bik $bik = null )
    {
        $this->bikDefault = $bik;
        parent::__construct(Correspondent::class);
    }

    protected function checkDigitStart( string $number ): string
    {
        return '0' . substr( (string) $this->bikDefault, -5, 2) . $number;
    }
}