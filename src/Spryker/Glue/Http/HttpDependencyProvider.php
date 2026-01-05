<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\Http;

use Spryker\Glue\Http\Plugin\Http\HIncludeRendererFragmentHandlerPlugin;
use Spryker\Glue\Http\Plugin\Http\InlineRendererFragmentHandlerPlugin;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Spryker\Glue\Http\HttpConfig getConfig()
 */
class HttpDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PLUGINS_FRAGMENT_HANDLER = 'PLUGINS_FRAGMENT_HANDLER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addFragmentHandlerPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
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
        return [
            new HIncludeRendererFragmentHandlerPlugin(),
            new InlineRendererFragmentHandlerPlugin(),
        ];
    }
}
