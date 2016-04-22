<?php

namespace NS\Bundle\CoreBundle\Provider;

/**
 * Class UsernameOrEmailProvider
 */
class UsernameOrEmailProvider extends AbstractUserProvider
{
    /**
     * {@inheritdoc}
     */
    protected function findUser($usernameOrEmail)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->userRepository->findOneByEmail($usernameOrEmail);
        }

        return $this->userRepository->findOneBy(['usernameCanonical' => $usernameOrEmail]);
    }
}
