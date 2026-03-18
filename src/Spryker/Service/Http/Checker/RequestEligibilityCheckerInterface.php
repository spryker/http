<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http\Checker;

use Symfony\Component\HttpFoundation\Request;

interface RequestEligibilityCheckerInterface
{
    public function isRequestEligibleForRedirect(Request $request): bool;

    public function isValidRelativeUrl(string $url): bool;
}
