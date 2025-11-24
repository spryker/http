<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Http\Plugin\WebProfilerWidget;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\WebProfilerExtension\Dependency\Plugin\WebProfilerDataCollectorPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

/**
 * @method \Spryker\Yves\Http\HttpFactory getFactory()
 */
class WebProfilerExternalHttpDataCollectorPlugin extends AbstractPlugin implements WebProfilerDataCollectorPluginInterface
{
    protected const string DATA_COLLECTOR_NAME = 'external_http';

    protected const string DATA_TEMPLATE_NAME = '@Http/external-http';

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getName(): string
    {
        return static::DATA_COLLECTOR_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getTemplateName(): string
    {
        return static::DATA_TEMPLATE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getDataCollector(ContainerInterface $container): DataCollectorInterface
    {
        return $this->getFactory()->createExternalHttpDataCollector();
    }
}
