<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Test\Unit\Framework\Http;

use PHPUnit_Framework_TestCase;
use LapisAngularis\Senshu\Framework\Http\HttpRequest;

class HttpRequestTest extends PHPUnit_Framework_TestCase
{
    public function testGetParameter(): void
    {
        $get = ['getkey' => 'getvalue'];
        $post = ['postkey' => 'postvalue'];

        $request = new HttpRequest($get, $post, [], []);

        $this->assertEquals($request->getParameter('getkey'), $get['getkey']);
        $this->assertEquals($request->getParameter('postkey'), $post['postkey']);
        $this->assertNull($request->getParameter('nonExistingKey'));
    }
}
