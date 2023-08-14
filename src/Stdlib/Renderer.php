<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use TeamspeakServerManager\Exception\RuntimeException;

final readonly class Renderer
{
    public function __construct(
        private string $viewsDirectory,
    ) {
    }

    /**
     * @param array<string, mixed> $vars
     */
    public function render(string $template, array $vars = [], bool $withLayout = true): string
    {
        $templateFile = $this->viewsDirectory . '/' . $template;
        $layoutFile = $this->viewsDirectory . '/layout/layout.phtml';

        return (function (string $templateFile, string $layoutFile, array $vars, bool $withLayout): string {
            extract($vars);
            unset($vars);

            if (!is_file($templateFile)) {
                throw new RuntimeException(sprintf('Template file "%s" does not exist.', $templateFile));
            }

            ob_start();
            require $templateFile;
            if (false === $content = ob_get_clean()) {
                throw new RuntimeException(sprintf('"ob_get_clean" returned false for template file "%s".', $templateFile));
            }

            if ($withLayout === true) {
                if (!is_file($layoutFile)) {
                    throw new RuntimeException(sprintf('Layout file "%s" does not exist.', $layoutFile));
                }

                ob_start();
                require $layoutFile;
                if (false === $content = ob_get_clean()) {
                    throw new RuntimeException(sprintf('"ob_get_clean" returned false for layout file "%s".', $layoutFile));
                }
            }

            return $content;
        })($templateFile, $layoutFile, $vars, $withLayout);
    }
}
