<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http;

use Spryker\Service\Kernel\AbstractBundleConfig;

class HttpConfig extends AbstractBundleConfig
{
    protected const string INTERNAL_PATH_PREFIX = '/_';

    protected const string AUTHENTICATION_PATH_PATTERN = '#^/([^/]+/[^/]+/)?(login|logout)(/|$)#';

    protected const string ACCEPT_HEADER_HTML = 'text/html';

    protected const string HTTP_HEADER_ACCEPT = 'Accept';

    /**
     * Specification:
     * - Returns the URL path prefix used to identify internal framework paths excluded from redirect tracking.
     *
     * @api
     *
     * @return string
     */
    public function getInternalPathPrefix(): string
    {
        return static::INTERNAL_PATH_PREFIX;
    }

    /**
     * Specification:
     * - Returns the regex pattern used to match authentication paths (login/logout) excluded from redirect tracking.
     *
     * @api
     *
     * @return string
     */
    public function getAuthenticationPathPattern(): string
    {
        return static::AUTHENTICATION_PATH_PATTERN;
    }

    /**
     * Specification:
     * - Returns the list of accepted content type values used to check if the request accepts a supported response.
     *
     * @api
     *
     * @return array<string>
     */
    public function getSupportedAcceptHeaderValues(): array
    {
        return [static::ACCEPT_HEADER_HTML];
    }

    /**
     * Specification:
     * - Returns the HTTP Accept header name used to read the accepted content types from the request when checking redirect eligibility.
     *
     * @api
     *
     * @return string
     */
    public function getHttpHeaderAccept(): string
    {
        return static::HTTP_HEADER_ACCEPT;
    }
}
