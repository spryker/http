<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Service\Http;

use Codeception\Test\Unit;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Service
 * @group Http
 * @group HttpServiceTest
 * Add your own group annotations below this line
 *
 * @property \SprykerTest\Service\Http\HttpServiceTester $tester
 */
class HttpServiceTest extends Unit
{
    protected const string URL_PRODUCT = '/products/123';

    protected const string URL_INTERNAL_PATH = '/_profiler/wdt/abc123';

    protected const string URL_LOGIN = '/login';

    protected const string URL_LOGOUT = '/logout';

    protected const string URL_LOGIN_WITH_LOCALE_PREFIX = '/en/de/login';

    protected const string URL_ABSOLUTE = 'https://evil.com/steal';

    protected const string URL_PROTOCOL_RELATIVE = '//evil.com/steal';

    protected const string URL_NO_LEADING_SLASH = 'evil.com/steal';

    protected const string ACCEPT_HEADER_JSON = 'application/json';

    protected const string ACCEPT_HEADER_HTML = 'text/html,application/xhtml+xml';

    protected const string HEADER_VALUE_XML_HTTP_REQUEST = 'XMLHttpRequest';

    public function testGivenEligibleGetRequestWhenCheckingEligibilityForRedirectThenReturnsTrue(): void
    {
        // Arrange
        $request = Request::create(static::URL_PRODUCT);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertTrue($result);
    }

    public function testGivenPostRequestWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_PRODUCT, Request::METHOD_POST);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenAjaxRequestWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_PRODUCT, Request::METHOD_GET, [], [], [], ['HTTP_X_REQUESTED_WITH' => static::HEADER_VALUE_XML_HTTP_REQUEST]);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenNonHtmlAcceptHeaderWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_PRODUCT, Request::METHOD_GET, [], [], [], ['HTTP_ACCEPT' => static::ACCEPT_HEADER_JSON]);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenHtmlAcceptHeaderWhenCheckingEligibilityForRedirectThenReturnsTrue(): void
    {
        // Arrange
        $request = Request::create(static::URL_PRODUCT, Request::METHOD_GET, [], [], [], ['HTTP_ACCEPT' => static::ACCEPT_HEADER_HTML]);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertTrue($result);
    }

    public function testGivenInternalPathWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_INTERNAL_PATH);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenLoginPathWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_LOGIN);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenLogoutPathWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_LOGOUT);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenLoginPathWithLocalePrefixWhenCheckingEligibilityForRedirectThenReturnsFalse(): void
    {
        // Arrange
        $request = Request::create(static::URL_LOGIN_WITH_LOCALE_PREFIX);

        // Act
        $result = $this->tester->getHttpService()->isRequestEligibleForRedirect($request);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenRelativeUrlWhenValidatingThenReturnsTrue(): void
    {
        // Act
        $result = $this->tester->getHttpService()->isValidRelativeUrl(static::URL_PRODUCT);

        // Assert
        $this->assertTrue($result);
    }

    public function testGivenAbsoluteUrlWhenValidatingThenReturnsFalse(): void
    {
        // Act
        $result = $this->tester->getHttpService()->isValidRelativeUrl(static::URL_ABSOLUTE);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenProtocolRelativeUrlWhenValidatingThenReturnsFalse(): void
    {
        // Act
        $result = $this->tester->getHttpService()->isValidRelativeUrl(static::URL_PROTOCOL_RELATIVE);

        // Assert
        $this->assertFalse($result);
    }

    public function testGivenUrlWithoutLeadingSlashWhenValidatingThenReturnsFalse(): void
    {
        // Act
        $result = $this->tester->getHttpService()->isValidRelativeUrl(static::URL_NO_LEADING_SLASH);

        // Assert
        $this->assertFalse($result);
    }
}
