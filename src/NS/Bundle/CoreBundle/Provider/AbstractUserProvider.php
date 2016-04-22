<?php

namespace NS\Bundle\CoreBundle\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use NS\Bundle\CoreBundle\Doctrine\ORM\UserRepository;
use NS\Bundle\CoreBundle\Canonicalizer\Canonicalizer;
use NS\Bundle\CoreBundle\Entity\User as NSUser;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AbstractUserProvider
 */
abstract class AbstractUserProvider implements UserProviderInterface
{
    /**
     * @var string
     */
    protected $supportedUserClass = UserInterface::class;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var Canonicalizer
     */
    protected $canonicalizer;

    /**
     * @param UserRepository $userRepository
     * @param Canonicalizer  $canonicalizer
     */
    public function __construct(UserRepository $userRepository, Canonicalizer $canonicalizer)
    {
        $this->userRepository = $userRepository;
        $this->canonicalizer = $canonicalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($usernameOrEmail)
    {
        $usernameOrEmail = $this->canonicalizer->canonicalize($usernameOrEmail);
        $user = $this->findUser($usernameOrEmail);

        if (null === $user) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $usernameOrEmail)
            );
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof NSUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        if (null === $reloadedUser = $this->userRepository->find($user->getId())) {
            throw new UsernameNotFoundException(
                sprintf('User with ID "%d" could not be refreshed.', $user->getId())
            );
        }

        return $reloadedUser;
    }

    /**
     * {@inheritdoc}
     */
    abstract protected function findUser($uniqueIdentifier);

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $this->supportedUserClass === $class || is_subclass_of($class, $this->supportedUserClass);
    }
}
