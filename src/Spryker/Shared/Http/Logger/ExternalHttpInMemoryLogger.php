<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Http\Logger;

class ExternalHttpInMemoryLogger implements ExternalHttpInMemoryLoggerInterface
{
    /**
     * @var array<int, array<string, string>>
     */
    protected static array $logs = [];

    public static function getInstance(): static
    {
        static $instance = null;

        if ($instance === null) {
            /**@phpstan-ignore-next-line */
            $instance = new static();
        }

        return $instance;
    }

    public function log(
        string $method,
        string $url,
        mixed $requestData = null,
        mixed $responseData = null,
    ): void {
        static::$logs[] = [
            'method' => $method,
            'url' => $url,
            'request_data' => json_encode($requestData, JSON_PRETTY_PRINT) ?: '',
            'response_data' => json_encode($responseData, JSON_PRETTY_PRINT) ?: '',
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function getLogs(): array
    {
        return static::$logs;
    }
}
