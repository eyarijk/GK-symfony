<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class FilterTwig extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('my_ucfirst',[$this,'ucFirst']),
        ];
    }

    public function ucFirst(string $string): string
    {
        return \ucfirst($string);
    }
}