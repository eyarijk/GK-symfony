<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class FilterTwig extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('found',[$this,'found']),
        ];
    }

    public function found(string $text,string $world): string
    {
        return str_ireplace($world, "<span class=\"highlighted\">$world</span>", $text);
    }
}