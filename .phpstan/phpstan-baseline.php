<?php declare(strict_types = 1);

$ignoreErrors = [];
   $ignoreErrors[] = [
	'message' => '#^Cannot access offset \'env\' on mixed\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/../src/Stdlib/Config.php',
];
   $ignoreErrors[] = [
	'message' => '#^Method TeamspeakServerManager\\\\Stdlib\\\\Config\\:\\:get\\(\\) should return array but returns mixed\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/../src/Stdlib/Config.php',
];
   $ignoreErrors[] = [
	'message' => '#^Method TeamspeakServerManager\\\\Stdlib\\\\Config\\:\\:getAppEnv\\(\\) should return string but returns mixed\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/../src/Stdlib/Config.php',
];
   $ignoreErrors[] = [
	'message' => '#^Method TeamspeakServerManager\\\\Stdlib\\\\Config\\:\\:getRoutes\\(\\) should return array\\<array\\{url\\: string, methods\\: array\\<int, string\\>, controller\\: class\\-string\\<TeamspeakServerManager\\\\Interface\\\\ControllerInterface\\>\\}\\> but returns mixed\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/../src/Stdlib/Config.php',
];
   $ignoreErrors[] = [
	'message' => '#^Method TeamspeakServerManager\\\\Stdlib\\\\Config\\:\\:getServices\\(\\) should return array\\<class\\-string, class\\-string\\<TeamspeakServerManager\\\\Interface\\\\FactoryInterface\\>\\> but returns mixed\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/../src/Stdlib/Config.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
