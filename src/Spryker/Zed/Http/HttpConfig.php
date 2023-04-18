<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Http;

use Spryker\Shared\Http\HttpConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @method \Spryker\Shared\Http\HttpConfig getSharedConfig()
 */
class HttpConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    protected const DEFAULT_REQUEST_HTTP_PORT = 80;

    /**
     * @var int
     */
    protected const DEFAULT_REQUEST_HTTPS_PORT = 443;

    /**
     * @api
     *
     * @return int
     */
    public function getHttpPort(): int
    {
        return $this->get(HttpConstants::ZED_HTTP_PORT, static::DEFAULT_REQUEST_HTTP_PORT);
    }

    /**
     * @api
     *
     * @return int
     */
    public function getHttpsPort(): int
    {
        return $this->get(HttpConstants::ZED_HTTPS_PORT, static::DEFAULT_REQUEST_HTTPS_PORT);
    }

    /**
     * @api
     *
     * @return int
     */
    public function getTrustedHeaderSet(): int
    {
        return $this->getSharedConfig()->getTrustedHeaderSet();
    }

    /**
     * @api
     *
     * @return array<string>
     */
    public function getTrustedProxies(): array
    {
        return $this->get(HttpConstants::ZED_TRUSTED_PROXIES, []);
    }

    /**
     * @api
     *
     * @return array<string>
     */
    public function getTrustedHosts(): array
    {
        return $this->get(HttpConstants::ZED_TRUSTED_HOSTS, []);
    }

    /**
     * @api
     *
     * @return bool
     */
    public function isHstsEnabled(): bool
    {
        return $this->get(HttpConstants::ZED_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED, false);
    }

    /**
     * @api
     *
     * @return array<string, mixed>
     */
    public function getHstsConfig(): array
    {
        return $this->get(HttpConstants::ZED_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG, []);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getHttpFragmentPath(): string
    {
        return $this->getSharedConfig()->getHttpFragmentPath();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getUriSignerSecret(): string
    {
        return $this->getSharedConfig()->getUriSignerSecret();
    }

    /**
     * @api
     *
     * @return string|null
     */
    public function getHIncludeRendererGlobalTemplate(): ?string
    {
        return $this->getSharedConfig()->getHIncludeRendererGlobalTemplate();
    }

    /**
     * Specification:
     *  - Defines Cache-Control directives.
     *
     * Example:
     * [
     *      'public' = true,
     *      'max-age' = 3600,
     * ]
     *
     * @api
     *
     * @return array<string, mixed>
     */
    public function getCacheControlConfig(): array
    {
        return $this->get(HttpConstants::ZED_HTTP_CACHE_CONTROL_CONFIG, []);
    }
}
