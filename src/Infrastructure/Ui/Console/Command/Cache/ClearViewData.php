<?php
declare(strict_types=1);

namespace Console\Command\Cache;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Zend\Config\Config;

class ClearViewData extends Command
{
    private $viewCacheDir;

    public function __construct(Config $config, ?string $name = null)
    {
        $config = $config->get('app')->toArray();
        $this->viewCacheDir =  $config['cache_dir'] . '/view';
        parent::__construct($name);
    }

    /**
     * @inheritdoc
     * @throws InvalidArgumentException
     */
    protected function configure() : void
    {
        $this
            ->setName('cache:clear-view-data')
            ->setDescription('Clears generated cache file.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln(' Files under ' . $this->viewCacheDir . ' will be deleted.');
        if ($this->viewCacheDir   !== '/view') {
            foreach (glob( $this->viewCacheDir . '/*') as $folder) {
                $files = glob($folder . '/*');
                $output->writeln(' Files under ' . $folder . ' will be deleted.');
                foreach ($files as $file) {
                    $unlinkResult = file_exists($file)
                        ? (unlink($file) === true) ? 'deleted.' : 'could\'t deleted'
                        : ' file does not exist';
                    $output->writeln(' ' .$file . ' ' . $unlinkResult);
                }
                rmdir($folder);
                $output->writeln(' ' . $folder . ' emptied.');
            }
        }
        $output->writeln(' ' .$this->viewCacheDir .' emptied.');
    }
}
