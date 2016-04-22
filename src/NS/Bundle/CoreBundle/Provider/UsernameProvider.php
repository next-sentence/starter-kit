<?php

namespace NS\Bundle\CoreBundle\Provider;

/**
 * Class UsernameProvider
 */
class UsernameProvider extends AbstractUserProvider
{
    /**
     * {@inheritdoc}
     */
    protected function findUser($username)
    {
        return $this->userRepository->findOneBy(['usernameCanonical' => $username]);
    }
}
