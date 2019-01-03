<?php
declare(strict_types=1);

namespace Console\Command\Server;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Console\Style\SymfonyStyle;

class ServerRun extends Command
{
    /**
     * @inheritdoc
     * @throws InvalidArgumentException
     */
    protected function configure() : void
    {
        $this
            ->setName('server:run')
            ->setAliases(['serve'])
            ->addUsage('--host=127.0.0.1 --port=8080 --public=./webroot')
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, 'Hostname of the site', '127.0.0.1')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'Web port', '8080')
            ->addOption('public', null, InputOption::VALUE_OPTIONAL, 'Public web root.', './src/Infrastructure/Ui/Web/public')
            ->setDescription('Run development web server locally');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('<info>SELAMI DEVELOPMENT SERVER</info>');
        $io->section('<info>Clearing previously generated cache files.</info>');
        $command = $this->getApplication()->find('cache:clear-all');
        $command->run(new ArrayInput(['command'=> 'cache:clear-all']), $output);
        $output->writeln(' ');
        $io->section('<info>Starting Selami local development web server.</info>');
        $hostName = $input->getOption('host');
        $port = $input->getOption('port');
        $publicFolder = $input->getOption('public');
        $output->writeln(
            sprintf(
                " Host: <info>%s</info>\n Port: <info>%s</info>\n Public Folder: <info>%s</info>",
                $hostName,
                $port,
                $publicFolder
            )
        );
        $output->writeln(' ');
        $io->success(' Development server started. You can stop web server anytime by pressing Ctrl+C on keyboard.');
        $process = new Process('php -S ' . $hostName . ':' . $port . ' -t ' . $publicFolder);
        $process->setTimeout(null);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output->writeln($process->getOutput());
    }
}
