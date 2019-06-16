<?php

namespace Tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest as Request;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase {

    public function testRedirectTrailingSlash() {
        $app = new App();
        $request = new Request('GET', '/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog() {
        $app = new App();
        $request = new Request('GET', '/blog');
        $response = $app->run($request);
        $this->assertEquals('<h1>Bienvenue sur le blog</h1>', (string) $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test404() {
        $app = new App();
        $request = new Request('GET', '/azaaze');
        $response = $app->run($request);
        $this->assertEquals('<h1>Erreur 404</h1>', (string) $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }

}