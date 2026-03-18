<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http;

use Spryker\Service\Kernel\AbstractService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Service\Http\HttpServiceFactory getFactory()
 */
class HttpService extends AbstractService implements HttpServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    public function isRequestEligibleForRedirect(Request $request): bool
    {
        return $this->getFactory()
            ->createRequestEligibilityChecker()
            ->isRequestEligibleForRedirect($request);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $url
     *
     * @return bool
     */
    public function isValidRelativeUrl(string $url): bool
    {
        return $this->getFactory()
            ->createRequestEligibilityChecker()
            ->isValidRelativeUrl($url);
    }
}
