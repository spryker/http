<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http;

use Spryker\Yves\Http\Dependency\Client\HttpToLocaleClientBridge;
use Spryker\Yves\Http\Dependency\Client\HttpToStoreClientBridge;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

/**
 * @method \Spryker\Yves\Http\HttpConfig getConfig()
 */
class HttpDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_STORE = 'CLIENT_STORE';

    /**
     * @var string
     */
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    /**
     * @var string
     */
    public const PLUGINS_FRAGMENT_HANDLER = 'PLUGINS_FRAGMENT_HANDLER';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addLocaleClient($container);
        $container = $this->addFragmentHandlerPlugins($container);
        $container = $this->addStoreClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addLocaleClient(Container $container): Container
    {
        $container->set(static::CLIENT_LOCALE, function (Container $container) {
            return new HttpToLocaleClientBridge($container->getLocator()->locale()->client());
        });

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addFragmentHandlerPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_FRAGMENT_HANDLER, function () {
            return $this->getFragmentHandlerPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface>
     */
    protected function getFragmentHandlerPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORE, function (Container $container) {
            return new HttpToStoreClientBridge(
                $container->getLocator()->store()->client(),
            );
        });

        return $container;
    }
}
