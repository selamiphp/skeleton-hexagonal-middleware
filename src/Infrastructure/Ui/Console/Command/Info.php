<?php
declare(strict_types=1);

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Zend\Config\Config;

class Info extends Command
{
    private $config;
    public function __construct(Config $config, ?string $name = null)
    {
        $this->config = $config->toArray();
        parent::__construct($name);
    }

    /**
     * @inheritdoc
     * @throws InvalidArgumentException
     */
    protected function configure() : void
    {
        $this
            ->setName('info')
            ->setDescription('Displays configuration.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln(json_encode($this->config, JSON_PRETTY_PRINT));
    }
}
