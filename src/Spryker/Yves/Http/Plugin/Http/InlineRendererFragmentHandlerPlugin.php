<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http\Plugin\Http;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\HttpExtension\Dependency\Plugin\FragmentHandlerPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;
use Symfony\Component\HttpKernel\Fragment\FragmentRendererInterface;
use Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * @method \Spryker\Yves\Http\HttpFactory getFactory()
 * @method \Spryker\Yves\Http\HttpConfig getConfig()
 */
class InlineRendererFragmentHandlerPlugin extends AbstractPlugin implements FragmentHandlerPluginInterface
{
    /**
     * @uses \Spryker\Yves\Http\Plugin\Application\HttpApplicationPlugin::SERVICE_KERNEL
     *
     * @var string
     */
    protected const SERVICE_KERNEL = 'kernel';

    /**
     * @uses \Spryker\Yves\EventDispatcher\Plugin\Application\EventDispatcherApplicationPlugin::SERVICE_DISPATCHER
     *
     * @var string
     */
    protected const SERVICE_EVENT_DISPATCHER = 'dispatcher';

    /**
     * {@inheritDoc}
     * - Adds `InlineFragmentRenderer`.
     *
     * @api
     *
     * @param \Symfony\Component\HttpKernel\Fragment\FragmentHandler $fragmentHandler
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\HttpKernel\Fragment\FragmentHandler
     */
    public function extend(FragmentHandler $fragmentHandler, ContainerInterface $container): FragmentHandler
    {
        $fragmentHandler->addRenderer($this->createInlineFragmentRenderer($container));

        return $fragmentHandler;
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\HttpKernel\Fragment\FragmentRendererInterface
     */
    protected function createInlineFragmentRenderer(ContainerInterface $container): FragmentRendererInterface
    {
        $inlineFragmentRenderer = new InlineFragmentRenderer(
            $this->getHttpKernel($container),
            $this->getEventDispatcher($container),
        );
        $inlineFragmentRenderer->setFragmentPath($this->getConfig()->getHttpFragmentPath());

        return $inlineFragmentRenderer;
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected function getHttpKernel(ContainerInterface $container): HttpKernelInterface
    {
        return $container->get(static::SERVICE_KERNEL);
    }

    /**
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected function getEventDispatcher(ContainerInterface $container): EventDispatcherInterface
    {
        return $container->get(static::SERVICE_EVENT_DISPATCHER);
    }
}
