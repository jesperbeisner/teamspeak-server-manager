<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use Swoole\Http\Response as SwooleResponse;
use TeamspeakServerManager\Enum\ContentTypeEnum;
use TeamspeakServerManager\Interface\ResponseInterface;

final class Response implements ResponseInterface
{
    /** @var array<string, ContentTypeEnum> */
    private const CONTENT_TYPES = [
        'css' => ContentTypeEnum::CSS,
        'js' => ContentTypeEnum::JS,
        'ico' => ContentTypeEnum::ICO,
        'txt' => ContentTypeEnum::PLAIN,
    ];

    private int $statusCode;

    private ContentTypeEnum $contentType;

    private string $content;

    private string $template;

    /** @var array<string, mixed> */
    private array $vars;

    private bool $withLayout;

    /** @var array<string, string|int|float> */
    private array $headers = [];

    public function send(SwooleResponse $swooleResponse): void
    {
        $swooleResponse->status($this->statusCode);
        $swooleResponse->setHeader('Content-Type', $this->contentType->value);

        foreach ($this->headers as $key => $value) {
            $swooleResponse->setHeader($key, (string) $value);
        }

        $swooleResponse->end($this->content);
    }

    /**
     * @param array<string, mixed> $vars
     */
    public function html(string $template, array $vars = [], int $statusCode = 200, bool $withLayout = true): void
    {
        $this->statusCode = $statusCode;
        $this->contentType = ContentTypeEnum::HTML;
        $this->template = $template;
        $this->vars = $vars;
        $this->withLayout = $withLayout;
    }

    public function file(string $fileName): void
    {
        if (!file_exists($fileName)) {
            $this->statusCode = 404;
            $this->contentType = ContentTypeEnum::PLAIN;
            $this->content = '404 - File does not exist.';

            return;
        }

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!array_key_exists($extension, self::CONTENT_TYPES)) {
            $this->statusCode = 404;
            $this->contentType = ContentTypeEnum::PLAIN;
            $this->content = '404 - File does not exist.';

            return;
        }

        $this->statusCode = 200;
        $this->contentType = self::CONTENT_TYPES[$extension];
        $this->content = file_get_contents($fileName);
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContentType(): ContentTypeEnum
    {
        return $this->contentType;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return array<string, mixed>
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    public function getWithLayout(): bool
    {
        return $this->withLayout;
    }

    public function setHeader(string $key, string|int|float $value): void
    {
        $this->headers[$key] = $value;
    }
}
