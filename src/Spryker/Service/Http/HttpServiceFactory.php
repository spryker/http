<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Http;

use Spryker\Service\Http\Checker\RequestEligibilityChecker;
use Spryker\Service\Http\Checker\RequestEligibilityCheckerInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \Spryker\Service\Http\HttpConfig getConfig()
 */
class HttpServiceFactory extends AbstractServiceFactory
{
    public function createRequestEligibilityChecker(): RequestEligibilityCheckerInterface
    {
        return new RequestEligibilityChecker($this->getConfig());
    }
}
