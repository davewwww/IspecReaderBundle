<?php

namespace Dwo\IspecReaderBundle\Command;

use Dwo\Ispec\Finder\IpInfoFinder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FinderCommand
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class FinderCommand extends ContainerAwareCommand
{
    /**
     * @var string
     */
    protected $kernelDir;

    /**
     * @var IpInfoFinder
     */
    protected $finder;

    /**
     * @see Command
     */
    protected function configure()
    {
        $this->setName('dwo_ispec_reader:find')
            ->addArgument('ip', InputArgument::REQUIRED, 'ip');
    }

    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->finder = $this->getContainer()->get('dwo_ispec_reader.finder');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(null !== $ipInfo = $this->finder->findByIp($input->getArgument('ip'))) {
            $output->writeln('<comment>Subnet:</comment> ' . $ipInfo->subnet);
            $output->writeln('<comment>ISP:</comment> ' . $ipInfo->isp);
            $output->writeln('<comment>ASN:</comment> ' . $ipInfo->asn);
        }
        else {
            $output->writeln('found no ip info');
        }
    }
}