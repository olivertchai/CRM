<?php

namespace Tests\Browser\Campaigns;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_should_redirect_if_not_authenticated_to_index(): void
    {
        $page = file_get_contents('http://web/campaigns');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_show(): void
    {
        $page = file_get_contents('http://web/campaigns/1');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_edit(): void
    {
        $page = file_get_contents('http://web/campaigns/1/edit');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_new(): void
    {
        $page = file_get_contents('http://web/campaigns/new');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_logout_successfully(): void
    {
        $page = file_get_contents('http://web/logout');

        $statusCode = $http_response_header[0];
        $location = "";

        foreach ($http_response_header as $header) {
            if (stripos($header, 'Location:') === 0) {
                $location = trim(str_replace('Location:', '', $header));
                break;
            }
        }

        $this->assertStringContainsString('302', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_access_page_login(): void
    {
        $page = file_get_contents('http://web/login');

        $statusCode = $http_response_header[0];

        $this->assertEquals('HTTP/1.1 200 OK', $statusCode);
    }

    public function test_authenticated_user_should_be_redirected_when_accessing_login_page(): void
    {
        // Simulate user authentication by setting a cookie
        $cookie = 'auth_token=valid_token; Path=/; HttpOnly';
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => "Cookie: $cookie\r\n"
            ]
        ];
        $context = stream_context_create($opts);

        $page = file_get_contents('http://web/login', false, $context);

        $statusCode = $http_response_header[0];
        $location = "";

        foreach ($http_response_header as $header) {
            if (stripos($header, 'Location:') === 0) {
                $location = trim(str_replace('Location:', '', $header));
                break;
            }
        }

        $this->assertStringContainsString('302', $statusCode);
        $this->assertEquals('Location: /campaigns', $location);
    }
}
