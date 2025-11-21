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
use Throwable;

class ExternalHttpDataCollector extends DataCollector
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
