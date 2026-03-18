<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http;

use Symfony\Component\HttpFoundation\Request;

interface HttpServiceInterface
{
    /**
     * Specification:
     * - Returns `true` if the request can be used as a redirect target.
     * - Returns `false` for AJAX requests, non-GET methods, authentication paths, and internal framework paths.
     *
     * @api
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    public function isRequestEligibleForRedirect(Request $request): bool;

    /**
     * Specification:
     * - Returns `true` if the URL is a valid relative URL safe to use as a redirect target.
     * - Returns `false` for absolute URLs, protocol-relative URLs, and any URL not starting with `/`.
     *
     * @api
     *
     * @param string $url
     *
     * @return bool
     */
    public function isValidRelativeUrl(string $url): bool;
}
