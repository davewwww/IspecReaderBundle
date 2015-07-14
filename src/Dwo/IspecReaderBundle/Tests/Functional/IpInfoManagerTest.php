<?php

namespace Dwo\IspecReaderBundle\Tests\Functional;

use Dwo\Ispec\Model\IpInfo;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;
use Dwo\Ispec\Model\IpInfoManagerInterface;
use Dwo\IspecReaderBundle\Tests\Functional\app\AppKernel;

class IpInfoManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testFindAll()
    {
        $kernel = new AppKernel('Framework', 'config.yml', 'test', true);
        $kernel->boot();

        /** @var IpInfoFindAllManagerInterface $manager */
        $manager = $kernel->getContainer()->get('dwo_ispec_reader.manager');
        $ipinfos = $manager->findAll();

        self::assertCount(1, $ipinfos);

        /** @var IpInfo $ipinfo */
        $ipinfo = current($ipinfos);

        self::assertInstanceOf('Dwo\Ispec\Model\IpInfo', $ipinfo);
    }

    public function testFindByKey()
    {
        $kernel = new AppKernel('Framework', 'config.yml', 'test', true);
        $kernel->boot();

        /** @var IpInfoFindAllManagerInterface $manager */
        $manager = $kernel->getContainer()->get('dwo_ispec_reader.manager');
        $ipinfos = $manager->findAllByKey(68);

        self::assertCount(1, $ipinfos);

        /** @var IpInfo $ipinfo */
        $ipinfo = current($ipinfos);

        self::assertInstanceOf('Dwo\Ispec\Model\IpInfo', $ipinfo);
        self::assertEquals(68, $ipinfo->key);
    }

    public function testFindNothing()
    {
        $kernel = new AppKernel('Framework', 'config.yml', 'test', true);
        $kernel->boot();

        /** @var IpInfoFindAllManagerInterface $manager */
        $manager = $kernel->getContainer()->get('dwo_ispec_reader.manager');
        $ipinfos = $manager->findAllByKey(0);

        self::assertCount(0, $ipinfos);
    }
}