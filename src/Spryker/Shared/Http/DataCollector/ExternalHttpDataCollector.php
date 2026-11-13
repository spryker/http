<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Http\DataCollector;

use Spryker\Shared\Http\Logger\ExternalHttpInMemoryLoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\LateDataCollectorInterface;
use Throwable;

class ExternalHttpDataCollector extends DataCollector implements LateDataCollectorInterface
{
    protected const string DATA_COLLECTOR_NAME = 'external_http';

    protected const string KEY_LOGS = 'logs';

    protected const string KEY_METHOD = 'method';

    protected const string KEY_URL = 'url';

    protected const string KEY_REQUEST_DATA = 'request_data';

    protected const string KEY_RESPONSE_DATA = 'response_data';

    public function __construct(
        protected ExternalHttpInMemoryLoggerInterface $externalHttpInMemoryLogger,
    ) {
    }

    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
    }

    /**
     * Runs on kernel.terminate, after StreamedResponse has executed its callback: without this the
     * profile is collected before the stream body runs and external calls made there are lost.
     */
    public function lateCollect(): void
    {
        $logs = [];

        foreach ($this->externalHttpInMemoryLogger->getLogs() as $log) {
            $logs[] = [
                static::KEY_METHOD => $log[static::KEY_METHOD] ?? null,
                static::KEY_URL => $log[static::KEY_URL] ?? null,
                static::KEY_REQUEST_DATA => $this->cloneVar($this->decodeLogValue($log[static::KEY_REQUEST_DATA] ?? null)),
                static::KEY_RESPONSE_DATA => $this->cloneVar($this->decodeLogValue($log[static::KEY_RESPONSE_DATA] ?? null)),
            ];
        }

        $this->data[static::KEY_LOGS] = $logs;
    }

    public function getName(): string
    {
        return static::DATA_COLLECTOR_NAME;
    }

    public function reset(): void
    {
        $this->data = [];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getLogs(): array
    {
        return $this->data[static::KEY_LOGS] ?? [];
    }

    protected function decodeLogValue(mixed $value): mixed
    {
        if (!is_string($value)) {
            return $value;
        }

        $decodedValue = json_decode($value, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $value;
        }

        return $decodedValue;
    }
}
