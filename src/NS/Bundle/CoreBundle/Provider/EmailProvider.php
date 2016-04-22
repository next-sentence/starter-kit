<?php

namespace NS\Bundle\CoreBundle\Provider;

/**
 * Class EmailProvider
 */
class EmailProvider extends AbstractUserProvider
{
    /**
     * {@inheritdoc}
     */
    protected function findUser($email)
    {
        return $this->userRepository->findOneByEmail($email);
    }
}
