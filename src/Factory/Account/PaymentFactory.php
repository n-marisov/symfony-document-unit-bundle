<?php

namespace Maris\Symfony\DocumentUnit\Factory\Account;

use Maris\Symfony\DocumentUnit\Entity\Account\Payment;
use Maris\Symfony\DocumentUnit\Entity\Bik;

/***
 * Фабрика для создания объекта банковского счета.
 */
class PaymentFactory extends AbstractAccountFactory
{

    public function __construct( Bik $bik = null )
    {
        $this->bikDefault = $bik;
        parent::__construct(Payment::class);
    }
    /**
     * Формирует начальные данные для расчета контрольной суммы
     * @param string $number
     * @return string
     */
    protected function checkDigitStart( string $number ):string
    {
        return substr( (string) $this->bikDefault, -3 ) . $number;
    }
}