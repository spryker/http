<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Http\Communication;

use Spryker\Zed\Http\Dependency\Facade\HttpToLocaleFacadeInterface;
use Spryker\Zed\Http\Dependency\Facade\HttpToStoreFacadeInterface;
use Spryker\Zed\Http\HttpDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\HttpKernel\EventListener\FragmentListener;
use Symfony\Component\HttpKernel\UriSigner;
use Twig\Extension\AbstractExtension;

/**
 * @method \Spryker\Zed\Http\HttpConfig getConfig()
 */
class HttpCommunicationFactory extends AbstractCommunicationFactory
{
    public function getLocaleFacade(): HttpToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(HttpDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return array<\Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface>
     */
    public function getFragmentHandlerPlugins(): array
    {
        return $this->getProvidedDependency(HttpDependencyProvider::PLUGINS_FRAGMENT_HANDLER);
    }

    public function createHttpKernelExtension(): AbstractExtension
    {
        return new HttpKernelExtension();
    }

    public function createHttpFragmentListener(): EventSubscriberInterface
    {
        return new FragmentListener($this->createUriSigner(), $this->getConfig()->getHttpFragmentPath());
    }

    public function createUriSigner(): UriSigner
    {
        return new UriSigner($this->getConfig()->getUriSignerSecret());
    }

    public function createFormTypeHttpFoundationExtension(): FormTypeExtensionInterface
    {
        return new FormTypeHttpFoundationExtension();
    }

    public function getStoreFacade(): HttpToStoreFacadeInterface
    {
        return $this->getProvidedDependency(HttpDependencyProvider::FACADE_STORE);
    }
}
