<?php

namespace Dwo\IspecReaderBundle\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;

/**
 * Class IpInfoManager
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpInfoManager implements IpInfoFindAllManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @param EntityManagerInterface $entityManager
     * @param string                 $class
     */
    public function __construct(EntityManagerInterface $entityManager, $class)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByKey($key)
    {
        return $this->repository->findBy(
            array(
                'key' => $key,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByIp($ip)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('i')
            ->from(get_class($this->class), 'i')
            ->where('i.ip_from >= :ip')
            ->andWhere('i.ip_to <= :ip')
            ->setParameter('ip', ip2long($ip));

        return $qb->getQuery()->getResult();
    }
}
