<?php

namespace NS\Bundle\CoreBundle\Provider;

//use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Provider\LocaleProviderInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TranslationLocaleProvider
 */
class TranslationLocaleProvider implements LocaleProviderInterface
{
//    /**
//     * @var LocaleContextInterface
//     */
//    private $localeContext;
//
//    /**
//     * @param LocaleContextInterface $localeContext
//     */
//    public function __construct(LocaleContextInterface $localeContext)
//    {
//        $this->localeContext = $localeContext;
//    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentLocale()
    {
//        return $this->localeContext->getCurrentLocale();
        return 'en';
    }

    /**
     * {@inheritdoc}
     */
    public function getFallbackLocale()
    {
//        return $this->localeContext->getDefaultLocale();
        return 'en';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLocale()
    {
//        return $this->localeContext->getDefaultLocale();
        return 'en';
    }
}
