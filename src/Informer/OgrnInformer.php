<?php

namespace Maris\Symfony\DocumentUnit\Informer;

use Maris\Symfony\DocumentUnit\Entity\Ogrn;

/**
 * Возвращает информацию об ОГРН.
 */
class OgrnInformer
{
    /**
     * Указывает что ОГРН принадлежит Индивидуальному Предпринимателю.
     * @param Ogrn $ogrn
     * @return bool
     */
    public function isIp( Ogrn $ogrn ):bool
    {
        $ogrn = (string) $ogrn;
        return strlen( $ogrn ) === 15 && intval($ogrn[0]) === 3;
    }
}