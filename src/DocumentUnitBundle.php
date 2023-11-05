<?php

namespace Maris\Symfony\DocumentUnit;

use Maris\Symfony\DocumentUnit\DependencyInjection\DocumentUnitExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class DocumentUnitBundle extends AbstractBundle{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new DocumentUnitExtension();
    }

}