<?php

declare(strict_types=1);

namespace Rahid\MacrosAssets\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MacroTrackingExtension extends AbstractExtension
{
    public function __construct(private readonly MacroTracker $tracker)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('_log_macro', fn ($name) => $this->tracker->log($name)),
            new TwigFunction('_render_assets', fn () => $this->tracker->renderAssets(), ['is_safe' => ['html']]),
        ];
    }
}
