<?php

declare(strict_types=1);

namespace Rahid\MacrosAssets\Twig;

class MacroTracker
{
    public function __construct(
        private readonly array $assetsMacros = [],
    ) {
    }

    private array $calledMacros = [];

    public function log(string $macroName): void
    {
        $this->calledMacros[$macroName] = true;
    }

    public function getCalledMacros(): array
    {
        return array_keys($this->calledMacros);
    }

    public function reset(): void
    {
        $this->calledMacros = [];
    }

    public function renderAssets(): string
    {
        $macros = $this->getCalledMacros();

        $cssTags = '';
        $jsTags = '';

        foreach ($macros as $macro) {
            if (isset($this->assetsMacros[$macro])) {
                if ($this->assetsMacros[$macro]['css']) {
                    foreach ($this->assetsMacros[$macro]['css'] as $cssFile) {
                        $cssTags .= sprintf('<link rel="stylesheet" href="%s">', $cssFile);
                    }
                }

                if ($this->assetsMacros[$macro]['js']) {
                    foreach ($this->assetsMacros[$macro]['js'] as $jsFile) {
                        $jsTags .= sprintf('<script src="%s"></script>', $jsFile);
                    }
                }
            }
        }

        dump($this->assetsMacros);

        return $cssTags.$jsTags;
    }
}
