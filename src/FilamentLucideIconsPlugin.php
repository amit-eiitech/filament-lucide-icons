<?php

namespace Eii\FilamentLucideIcons;

use Filament\Contracts\Plugin;
use Filament\Panel;
use InvalidArgumentException;

class FilamentLucideIconsPlugin implements Plugin
{
    protected int|float $strokeWidth = 2;

    public static function make(): static
    {
        return new static();
    }

    public function getId(): string
    {
        return 'eii-filament-lucide-icons';
    }

    /**
     * Set the default stroke width for all Lucide icons.
     */
    public function strokeWidth(int|float $width): static
    {
        if (! is_finite((float) $width) || $width <= 0) {
            throw new InvalidArgumentException(
                'Stroke width must be a positive number.'
            );
        }

        $this->strokeWidth = $width;

        return $this;
    }

    public function register(Panel $panel): void
    {
        $attributes = (array) config(
            'blade-lucide-icons.attributes',
            []
        );

        $attributes['stroke-width'] = (string) $this->strokeWidth;

        config([
            'blade-lucide-icons.attributes' => $attributes,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
