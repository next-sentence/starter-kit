<?php

namespace NS\Bundle\CoreBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 */
class UserRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     */
    public function findOneByEmail($email)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->leftJoin('o'.'.customer', 'customer')
            ->andWhere($queryBuilder->expr()->eq('customer.emailCanonical', ':email'))
            ->setParameter('email', $email)
        ;

        return $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}