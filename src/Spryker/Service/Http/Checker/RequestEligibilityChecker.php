<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http\Checker;

use Spryker\Service\Http\HttpConfig;
use Symfony\Component\HttpFoundation\Request;

class RequestEligibilityChecker implements RequestEligibilityCheckerInterface
{
    public function __construct(protected HttpConfig $config)
    {
    }

    public function isRequestEligibleForRedirect(Request $request): bool
    {
        if ($request->getMethod() !== Request::METHOD_GET) {
            return false;
        }

        if ($request->isXmlHttpRequest()) {
            return false;
        }

        $acceptHeader = $request->headers->get($this->config->getHttpHeaderAccept()) ?? '';
        if ($acceptHeader !== '' && !$this->isAcceptHeaderSupported($acceptHeader)) {
            return false;
        }

        $path = $request->getPathInfo();

        if (str_starts_with($path, $this->config->getInternalPathPrefix())) {
            return false;
        }

        if (preg_match($this->config->getAuthenticationPathPattern(), $path)) {
            return false;
        }

        if (!$this->isValidRelativeUrl($request->getRequestUri())) {
            return false;
        }

        return true;
    }

    public function isValidRelativeUrl(string $url): bool
    {
        if (str_contains($url, '://')) {
            return false;
        }

        if (str_starts_with($url, '//')) {
            return false;
        }

        return str_starts_with($url, '/');
    }

    protected function isAcceptHeaderSupported(string $acceptHeader): bool
    {
        foreach ($this->config->getSupportedAcceptHeaderValues() as $supportedValue) {
            if (str_contains($acceptHeader, $supportedValue)) {
                return true;
            }
        }

        return false;
    }
}
