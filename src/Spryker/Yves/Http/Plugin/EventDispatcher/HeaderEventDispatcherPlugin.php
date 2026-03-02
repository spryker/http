<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http\Plugin\EventDispatcher;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\EventDispatcher\EventDispatcherInterface;
use Spryker\Shared\EventDispatcherExtension\Dependency\Plugin\EventDispatcherPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @deprecated Use {@link \Spryker\Yves\Http\Plugin\EventDispatcher\EnvironmentInfoHeaderEventDispatcherPlugin} and {@link \Spryker\Yves\Http\Plugin\EventDispatcher\CacheControlHeaderEventDispatcherPlugin} instead.
 *
 * @method \Spryker\Yves\Http\HttpConfig getConfig()
 * @method \Spryker\Yves\Http\HttpFactory getFactory()
 */
class HeaderEventDispatcherPlugin extends AbstractPlugin implements EventDispatcherPluginInterface
{
    /**
     * {@inheritDoc}
     * - Sets environment main information in headers.
     * - Sets cache control.
     *
     * @api
     *
     * @param \Spryker\Shared\EventDispatcher\EventDispatcherInterface $eventDispatcher
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Spryker\Shared\EventDispatcher\EventDispatcherInterface
     */
    public function extend(EventDispatcherInterface $eventDispatcher, ContainerInterface $container): EventDispatcherInterface
    {
        $eventDispatcher->addListener(KernelEvents::RESPONSE, function (ResponseEvent $event): void {
            if (!$this->isMainRequest($event)) {
                return;
            }

            $response = $event->getResponse();

            $localeClient = $this->getFactory()->getLocaleClient();
            $storeClient = $this->getFactory()->getStoreClient();

            $response->headers->set('X-CodeBucket', APPLICATION_CODE_BUCKET);
            $response->headers->set('X-Store', $storeClient->getCurrentStore()->getNameOrFail());
            $response->headers->set('X-Env', APPLICATION_ENV);
            $response->headers->set('X-Locale', $localeClient->getCurrentLocale());

            $response->setPrivate()->setMaxAge(0);

            $response->headers->addCacheControlDirective('no-cache', true);
            $response->headers->addCacheControlDirective('no-store', true);
            $response->headers->addCacheControlDirective('must-revalidate', true);
        });

        return $eventDispatcher;
    }

    protected function isMainRequest(ResponseEvent $event): bool
    {
        if (method_exists($event, 'isMasterRequest')) {
            return $event->isMasterRequest();
        }

        return $event->isMainRequest();
    }
}
