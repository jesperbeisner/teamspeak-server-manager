<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use Swoole\Http\Response as SwooleResponse;

final readonly class Response
{
    public const CONTENT_TYPE_HTML = 'text/html; charset=utf-8';
    public const CONTENT_TYPE_CSS = 'text/css; charset=utf-8';
    public const CONTENT_TYPE_JAVA_SCRIPT = 'text/javascript; charset=utf-8';
    public const CONTENT_TYPE_X_ICON = 'image/x-icon';

    public function __construct(
        public int $statusCode,
        public string $contentType,
        public string $content,
        public string $template,
        public array $vars,
        public bool $standalone,
    ) {
    }

    public static function html(string $template, array $vars = [], int $statusCode = 200, bool $standalone = false): Response
    {
        return new Response($statusCode, Response::CONTENT_TYPE_HTML, '', $template, $vars, $standalone);
    }

    public static function css(string $content): Response
    {
        return new Response(200, Response::CONTENT_TYPE_CSS, $content, '', [], false);
    }

    public static function js(string $content): Response
    {
        return new Response(200, Response::CONTENT_TYPE_JAVA_SCRIPT, $content, '', [], false);
    }

    public static function favicon(string $content): Response
    {
        return new Response(200, Response::CONTENT_TYPE_X_ICON, $content, '', [], false);
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        $content = $this->content;

        if ($this->contentType === Response::CONTENT_TYPE_HTML) {
            $content = Renderer::render($this->template, $this->vars, $this->standalone);
        }

        $swooleResponse->setStatusCode($this->statusCode);
        $swooleResponse->setHeader('Content-Type', $this->contentType);

        $swooleResponse->end($content);
    }
}
