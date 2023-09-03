<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Enum;

enum ContentTypeEnum: string
{
    case HTML = 'text/html; charset=utf-8';
    case PLAIN = 'text/plain; charset=utf-8';
    case CSS = 'text/css; charset=utf-8';
    case JS = 'text/javascript; charset=utf-8';
    case ICO = 'image/x-icon';
}
