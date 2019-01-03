<?php
declare(strict_types=1);

namespace Console\Command\Cache;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Zend\Config\Config;

class ClearConfig extends Command
{
    private $cacheDir;

    public function __construct(Config $config, ?string $name = null)
    {
        $this->cacheDir = $config->get('app')->get('cache_dir', './cache');
        parent::__construct($name);
    }

    /**
     * @inheritdoc
     * @throws InvalidArgumentException
     */
    protected function configure() : void
    {
        $this
            ->setName('cache:clear-config')
            ->setDescription('Clears generated config file.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln(' Config cache files under ' . $this->cacheDir. ' will be deleted.');
        foreach (glob($this->cacheDir . '/*config.php') as $cachedConfigFile) {
            $unlinkResult  =  file_exists($cachedConfigFile)
                ? (unlink($cachedConfigFile) === true) ? 'deleted.' : 'could\'t deleted'
                :' file does not exist';
            $output->writeln(' '.$cachedConfigFile . ' ' . $unlinkResult);
        }
    }
}
