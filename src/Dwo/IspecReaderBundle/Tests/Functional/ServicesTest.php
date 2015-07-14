<?php

namespace Dwo\IspecReaderBundle\Tests\Functional;

use Dwo\Ispec\Model\IpInfo;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;
use Dwo\Ispec\Model\IpInfoManagerInterface;
use Dwo\IspecReaderBundle\Tests\Functional\app\AppKernel;

class ServicesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerServiceIds
     */
    public function testGetService($serviceId, $instance)
    {
        $kernel = new AppKernel('Framework', 'config.yml', 'test', true);
        $kernel->boot();

        $class = $kernel->getContainer()->get($serviceId);

        self::assertInstanceOf($instance, $class);
    }

    public function providerServiceIds() {
        return array(
            array('dwo_ispec_reader.manager', 'Dwo\Ispec\Model\IpInfoFindAllManagerInterface'),
            array('dwo_ispec_reader.finder', 'Dwo\Ispec\Finder\IpInfoFinderInterface'),
            array('dwo_ispec_reader.matcher.subnet', 'Dwo\Ispec\Matcher\IpInfoMatcherInterface'),
        );
    }
}
