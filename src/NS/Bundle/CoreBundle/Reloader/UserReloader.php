<?php

namespace NS\Bundle\CoreBundle\Reloader;

use Doctrine\Common\Persistence\ObjectManager;
use NS\Bundle\CoreBundle\Entity\User;

/**
 * Class UserReloader
 */
class UserReloader
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function reloadUser(User $user)
    {
        $this->objectManager->refresh($user);
    }
}
