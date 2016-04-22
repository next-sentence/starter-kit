<?php

namespace NS\Bundle\CoreBundle\Provider;

//use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Class AvailableLocalesProvider
 */
class AvailableLocalesProvider
{
    /**
     * @var RepositoryInterface
     */
    private $localeRepository;

//    /**
//     * @param RepositoryInterface $localeRepository
//     */
//    public function __construct(RepositoryInterface $localeRepository)
//    {
//        $this->localeRepository = $localeRepository;
//    }

    /**
     * @return array
     */
    public function getAvailableLocales()
    {
//        $localesCodes = [];
//        /** @var LocaleInterface[] $locales */
//        $locales = $this->localeRepository->findBy(['enabled' => true]);
//
//        foreach ($locales as $locale) {
//            $localesCodes[] = $locale->getCode();
//        }

        return ['en'];
    }
}
