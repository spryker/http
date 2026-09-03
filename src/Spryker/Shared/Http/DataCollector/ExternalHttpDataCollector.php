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

    public function __construct(
        protected ExternalHttpInMemoryLoggerInterface $externalHttpInMemoryLogger,
    ) {
    }

    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
        $this->data['logs'] = $this->externalHttpInMemoryLogger->getLogs();
    }

    /**
     * Runs on kernel.terminate, after StreamedResponse has executed its callback: without this the
     * profile is collected before the stream body runs and external calls made there are lost.
     */
    public function lateCollect(): void
    {
        $this->data['logs'] = $this->externalHttpInMemoryLogger->getLogs();
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
     * @return array<string, string>
     */
    public function getLogs(): array
    {
        return $this->data['logs'] ?? [];
    }
}
