<?php
declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$cachedConfigFile = './cache/ui.web.config.php';
$config = [];

if (is_file($cachedConfigFile)) {
    return require $cachedConfigFile;
}
$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();
foreach (Glob::glob('./config/autoload/{{,*.}global,{,*.}local,web/{,*.}global,web/{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}
if ((array_key_exists('config_cache_enabled', $config['app']) && $config['app']['config_cache_enabled'] === true)
    ||
    (isset($config['app']['environment']) && $config['app']['environment'] === 'prod')
) {
    file_put_contents(
        $cachedConfigFile,
        '<?php return ' . var_export($config, true) . ';',
        LOCK_EX
    );
}

return $config;
