<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Http\Logger;

interface ExternalHttpInMemoryLoggerInterface
{
    public function log(
        string $method,
        string $url,
        mixed $requestData = null,
        mixed $responseData = null,
    ): void;

    /**
     * @return array<int, array<string, string>>
     */
    public function getLogs(): array;
}
