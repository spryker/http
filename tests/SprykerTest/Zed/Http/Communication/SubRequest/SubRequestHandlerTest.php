<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Http\Communication\SubRequest;

use Codeception\Test\Unit;
use Spryker\Zed\Http\Communication\SubRequest\SubRequestHandler;
use SprykerTest\Zed\Http\HttpCommunicationTester;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group Http
 * @group Communication
 * @group SubRequest
 * @group SubRequestHandlerTest
 * Add your own group annotations below this line
 */
class SubRequestHandlerTest extends Unit
{
    /**
     * @var array<string, string>
     */
    public const GET_PARAMS = ['fruit' => 'mango'];

    /**
     * @var array<string, string>
     */
    public const POST_PARAMS = ['fruit' => 'orange'];

    protected HttpCommunicationTester $tester;

    protected function _setUp()
    {
        parent::_setUp();

        $this->tester->addRoute('test-get-route', '/sub-request-get', function (Request $request) {
            return new Response(sprintf('GET: fruit=%s', $request->query->get('fruit')));
        });

        $this->tester->addRoute('test-post-route', '/sub-request-post', function (Request $request) {
            return new Response(sprintf('POST: fruit=%s', $request->request->get('fruit')));
        });
    }

    /**
     * @return void
     */
    public function testHandleSubRequestWithGetParams(): void
    {
        $subRequestHandler = new SubRequestHandler($this->tester->getKernel());
        $request = new Request(static::GET_PARAMS);
        $response = $subRequestHandler->handleSubRequest($request, '/sub-request-get');

        $this->assertSame('GET: fruit=mango', $response->getContent());
    }

    /**
     * @return void
     */
    public function testHandleSubRequestWithPostParams(): void
    {
        $subRequestHandler = new SubRequestHandler($this->tester->getKernel());
        $request = new Request([], static::POST_PARAMS);
        $response = $subRequestHandler->handleSubRequest($request, '/sub-request-post');

        $this->assertSame('POST: fruit=orange', $response->getContent());
    }
}
