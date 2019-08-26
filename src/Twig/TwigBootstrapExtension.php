<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;


class TwigBootstrapExtension extends AbstractExtension {
    public function getFilters()
    {
        return [new TwigFilter('badge', [$this, 'badgeFilter'],['is_safe' => ['html']])];
    }

    public function badgeFilter($content, array $options = []): string
    {
        $defaultOptions = [
            'color' => 'primary'
        ];

        $options = array_merge ($defaultOptions,$options);

        $color = $options['color'];

        return '<span class="badge badge-' . $color . ' badge-pill ml-1 px-2 py-1 mb-1">' . $content . '</span>';
    }
}