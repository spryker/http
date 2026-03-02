<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

interface HttpToStoreClientInterface
{
    public function getCurrentStore(): StoreTransfer;
}
