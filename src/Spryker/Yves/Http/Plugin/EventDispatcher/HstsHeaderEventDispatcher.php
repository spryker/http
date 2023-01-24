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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @method \Spryker\Yves\Http\HttpConfig getConfig()
 * @method \Spryker\Yves\Http\HttpFactory getFactory()
 */
class HstsHeaderEventDispatcher extends AbstractPlugin implements EventDispatcherPluginInterface
{
    /**
     * @var string
     */
    protected const HEADER_HSTS = 'Strict-Transport-Security';

    /**
     * @var string
     */
    protected const HSTS_CONFIG_MAX_AGE = 'max_age';

    /**
     * @var string
     */
    protected const HSTS_CONFIG_INCLUDE_SUBDOMAINS = 'include_sub_domains';

    /**
     * @var string
     */
    protected const HSTS_CONFIG_PRELOAD = 'preload';

    /**
     * {@inheritDoc}
     * - Sets `Strict-Transport-Security` header to response.
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
            if (!$this->isMainRequest($event) || !$this->getConfig()->isHstsEnabled()) {
                return;
            }

            $event->setResponse($this->setHSTSHeader($event->getResponse()));
        });

        return $eventDispatcher;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function setHSTSHeader(Response $response): Response
    {
        $headerBody = $this->buildHeaderBody($this->getConfig()->getHstsConfig());
        if ($headerBody !== '') {
            $response->headers->set(static::HEADER_HSTS, $headerBody);
        }

        return $response;
    }

    /**
     * @param array $hstsConfig
     *
     * @return string
     */
    protected function buildHeaderBody(array $hstsConfig): string
    {
        $headerParts = [];
        if (!empty($hstsConfig[static::HSTS_CONFIG_MAX_AGE])) {
            $headerParts[] = sprintf('max-age=%s', $hstsConfig[static::HSTS_CONFIG_MAX_AGE]);
        }

        if (!empty($hstsConfig[static::HSTS_CONFIG_INCLUDE_SUBDOMAINS])) {
            $headerParts[] = 'includeSubDomains';
        }

        if (!empty($hstsConfig[static::HSTS_CONFIG_PRELOAD])) {
            $headerParts[] = 'preload';
        }

        return implode('; ', $headerParts);
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\ResponseEvent $event
     *
     * @return bool
     */
    protected function isMainRequest(ResponseEvent $event): bool
    {
        if (method_exists($event, 'isMasterRequest')) {
            return $event->isMasterRequest();
        }

        return $event->isMainRequest();
    }
}
