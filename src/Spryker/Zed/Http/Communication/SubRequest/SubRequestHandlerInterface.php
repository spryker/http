<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Http\Communication\SubRequest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SubRequestHandlerInterface
{
    public function handleSubRequest(Request $request, string $url, array $additionalSubRequestParameters = []): Response;
}
