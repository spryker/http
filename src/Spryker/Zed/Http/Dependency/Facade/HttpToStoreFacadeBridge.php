<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Http\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

class HttpToStoreFacadeBridge implements HttpToStoreFacadeInterface
{
    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct($storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    public function getCurrentStore(bool $fallbackToDefault = false): StoreTransfer
    {
        return $this->storeFacade->getCurrentStore($fallbackToDefault);
    }

    public function isCurrentStoreDefined(): bool
    {
        return $this->storeFacade->isCurrentStoreDefined();
    }
}
