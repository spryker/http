<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\Http;

use Spryker\Glue\Kernel\AbstractFactory;
use Spryker\Shared\Http\DataCollector\ExternalHttpDataCollector;
use Spryker\Shared\Http\Logger\ExternalHttpInMemoryLogger;
use Spryker\Shared\Http\Logger\ExternalHttpInMemoryLoggerInterface;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\HttpKernel\UriSigner;
use Twig\Extension\AbstractExtension;

/**
 * @method \Spryker\Glue\Http\HttpConfig getConfig()
 */
class HttpFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface
     */
    public function createExternalHttpDataCollector(): DataCollectorInterface
    {
        return new ExternalHttpDataCollector(
            $this->createExternalHttpInMemoryLogger(),
        );
    }

    /**
     * @return \Spryker\Shared\Http\Logger\ExternalHttpInMemoryLoggerInterface
     */
    public function createExternalHttpInMemoryLogger(): ExternalHttpInMemoryLoggerInterface
    {
        return ExternalHttpInMemoryLogger::getInstance();
    }

    /**
     * @return \Twig\Extension\AbstractExtension
     */
    public function createHttpKernelExtension(): AbstractExtension
    {
        return new HttpKernelExtension();
    }

    /**
     * @return array<\Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface>
     */
    public function getFragmentHandlerPlugins(): array
    {
        return $this->getProvidedDependency(HttpDependencyProvider::PLUGINS_FRAGMENT_HANDLER);
    }

    /**
     * @return \Symfony\Component\HttpKernel\UriSigner
     */
    public function createUriSigner(): UriSigner
    {
        return new UriSigner($this->getConfig()->getUriSignerSecret());
    }
}
