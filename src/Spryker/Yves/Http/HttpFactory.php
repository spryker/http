<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http;

use Spryker\Yves\Http\Dependency\Client\HttpToLocaleClientInterface;
use Spryker\Yves\Http\Dependency\Client\HttpToStoreClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\HttpKernel\EventListener\FragmentListener;
use Symfony\Component\HttpKernel\UriSigner;
use Twig\Extension\AbstractExtension;

/**
 * @method \Spryker\Yves\Http\HttpConfig getConfig()
 */
class HttpFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Yves\Http\Dependency\Client\HttpToLocaleClientInterface
     */
    public function getLocaleClient(): HttpToLocaleClientInterface
    {
        return $this->getProvidedDependency(HttpDependencyProvider::CLIENT_LOCALE);
    }

    /**
     * @return array<\Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface>
     */
    public function getFragmentHandlerPlugins(): array
    {
        return $this->getProvidedDependency(HttpDependencyProvider::PLUGINS_FRAGMENT_HANDLER);
    }

    /**
     * @return \Twig\Extension\AbstractExtension
     */
    public function createHttpKernelExtension(): AbstractExtension
    {
        return new HttpKernelExtension();
    }

    /**
     * @return \Symfony\Component\HttpKernel\UriSigner
     */
    public function createUriSigner(): UriSigner
    {
        return new UriSigner($this->getConfig()->getUriSignerSecret());
    }

    /**
     * @return \Symfony\Component\EventDispatcher\EventSubscriberInterface
     */
    public function createHttpFragmentListener(): EventSubscriberInterface
    {
        return new FragmentListener($this->createUriSigner(), $this->getConfig()->getHttpFragmentPath());
    }

    /**
     * @return \Symfony\Component\Form\FormTypeExtensionInterface
     */
    public function createFormTypeHttpFoundationExtension(): FormTypeExtensionInterface
    {
        return new FormTypeHttpFoundationExtension();
    }

    /**
     * @return \Spryker\Yves\Http\Dependency\Client\HttpToStoreClientInterface
     */
    public function getStoreClient(): HttpToStoreClientInterface
    {
        return $this->getProvidedDependency(HttpDependencyProvider::CLIENT_STORE);
    }
}
