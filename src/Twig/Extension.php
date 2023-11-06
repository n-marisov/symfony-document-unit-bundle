<?php

namespace Maris\Symfony\DocumentUnit\Twig;

use Maris\Symfony\DocumentUnit\Formatter\GeneralFormatter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Extension extends AbstractExtension
{
    public function getFilters():array
    {
        return [
            /**
             * Форматирует номер как в документе
             */
            new TwigFilter('documentFormat',[ GeneralFormatter::class, 'format' ])
        ];
    }
}