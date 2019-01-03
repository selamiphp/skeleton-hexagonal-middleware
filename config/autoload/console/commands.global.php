<?php
declare(strict_types=1);

return [
  'commands' => [
      Console\Command\Server\ServerRun::class,
      Console\Command\Cache\ClearConfig::class,
      Console\Command\Cache\ClearRouteDispatcherData::class,
      Console\Command\Cache\ClearViewData::class,
      Console\Command\Cache\ClearAll::class,
      Console\Command\Info::class,
  ]
];