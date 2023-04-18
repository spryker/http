<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Http;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface HttpConstants
{
    /**
     * Specification:
     *  - HTTP port for Yves.
     *
     * @api
     *
     * @var string
     */
    public const YVES_HTTP_PORT = 'HTTP:YVES_HTTP_PORT';

    /**
     * Specification:
     * - HTTPS port for Yves.
     *
     * @api
     *
     * @var string
     */
    public const YVES_HTTPS_PORT = 'HTTP:YVES_HTTPS_PORT';

    /**
     * Specification:
     * - IP address (or range) of your proxy.
     * - Example: `['192.0.0.1', '10.0.0.0/8']`.
     *
     * @api
     *
     * @var string
     */
    public const YVES_TRUSTED_PROXIES = 'HTTP:YVES_TRUSTED_PROXIES';

    /**
     * Specification:
     * - A bit field of trusted Request::HEADER_*, to set which headers to trust from your proxies.
     *
     * @api
     *
     * @var string
     */
    public const YVES_TRUSTED_HEADER = 'HTTP:YVES_TRUSTED_HEADER';

    /**
     * Specification:
     * - List of trusted hosts managed by regexp.
     *
     * @api
     *
     * @var string
     */
    public const YVES_TRUSTED_HOSTS = 'HTTP:YVES_TRUSTED_HOSTS';

    /**
     * Specification:
     * - If option set to true, the application will set http strict transport header.
     *
     * @api
     *
     * @var string
     */
    public const YVES_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED = 'HTTP:YVES_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED';

    /**
     * Specification:
     * - Http strict transport header body.
     *
     * @api
     *
     * @var string
     */
    public const YVES_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG = 'HTTP:YVES_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG';

    /**
     * Specification:
     * - HTTP Cache-Control header body.
     *
     * @api
     *
     * @var string
     */
    public const YVES_HTTP_CACHE_CONTROL_CONFIG = 'HTTP:YVES_HTTP_CACHE_CONTROL_CONFIG';

    /**
     * Specification:
     *  - HTTP port for Zed.
     *
     * @api
     *
     * @var string
     */
    public const ZED_HTTP_PORT = 'HTTP:ZED_HTTP_PORT';

    /**
     * Specification:
     * - HTTPS port for Zed.
     *
     * @api
     *
     * @var string
     */
    public const ZED_HTTPS_PORT = 'HTTP:ZED_HTTPS_PORT';

    /**
     * Specification:
     * - IP address (or range) of your proxy.
     * - Example: `['192.0.0.1', '10.0.0.0/8']`.
     *
     * @api
     *
     * @var string
     */
    public const ZED_TRUSTED_PROXIES = 'HTTP:ZED_TRUSTED_PROXIES';

    /**
     * Specification:
     * - List of trusted hosts managed by regexp.
     *
     * @api
     *
     * @var string
     */
    public const ZED_TRUSTED_HOSTS = 'HTTP:ZED_TRUSTED_HOSTS';

    /**
     * Specification:
     * - If option set to true, the application will set http strict transport header.
     *
     * @api
     *
     * @var string
     */
    public const ZED_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED = 'HTTP:ZED_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED';

    /**
     * Specification:
     * - Http strict transport header body.
     *
     * @api
     *
     * @var string
     */
    public const ZED_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG = 'HTTP:ZED_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG';

    /**
     * Specification:
     * - HTTP Cache-Control header body.
     *
     * @api
     *
     * @var string
     */
    public const ZED_HTTP_CACHE_CONTROL_CONFIG = 'HTTP:ZED_HTTP_CACHE_CONTROL_CONFIG';

    /**
     * Specification:
     *  - HTTP port for Glue.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_HTTP_PORT = 'HTTP:GLUE_HTTP_PORT';

    /**
     * Specification:
     * - HTTPS port for Glue.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_HTTPS_PORT = 'HTTP:GLUE_HTTPS_PORT';

    /**
     * Specification:
     * - IP address (or range) of your proxy.
     * - Example: `['192.0.0.1', '10.0.0.0/8']`.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_TRUSTED_PROXIES = 'HTTP:GLUE_TRUSTED_PROXIES';

    /**
     * Specification:
     * - List of trusted hosts managed by regexp.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_TRUSTED_HOSTS = 'HTTP:GLUE_TRUSTED_HOSTS';

    /**
     * Specification:
     * - If option set to true, the application will set HTTP strict transport header.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED = 'HTTP:GLUE_HTTP_STRICT_TRANSPORT_SECURITY_ENABLED';

    /**
     * Specification:
     * - HTTP strict transport header body.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG = 'HTTP:GLUE_HTTP_STRICT_TRANSPORT_SECURITY_CONFIG';

    /**
     * Specification:
     * - HTTP Cache-Control header body.
     *
     * @api
     *
     * @var string
     */
    public const GLUE_HTTP_CACHE_CONTROL_CONFIG = 'HTTP:GLUE_HTTP_CACHE_CONTROL_CONFIG';

    /**
     * Specification:
     * - Secret key for URL signer.
     *
     * @api
     *
     * @var string
     */
    public const URI_SIGNER_SECRET_KEY = 'HTTP:URI_SIGNER_SECRET_KEY';
}
