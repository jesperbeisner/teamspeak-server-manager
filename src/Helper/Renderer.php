<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Helper;

use RuntimeException;

final readonly class Renderer
{
    private const VIEWS_DIRECTORY = __DIR__ . '/../../views';

    /**
     * @param array<string, mixed> $vars
     */
    public static function render(string $template, array $vars = [], bool $withLayout = true): string
    {
        $templateFile = Renderer::VIEWS_DIRECTORY . '/' . $template;
        $layoutFile = Renderer::VIEWS_DIRECTORY . '/layout/layout.phtml';

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
    }
}
