<?php
/**
 * This file is part of the sauls/Xkcd-api-client package.
 *
 * @author    Saulius Vaičeliūnas <vaiceliunas@inbox.lt>
 * @link      http://saulius.vaiceliunas.lt
 * @copyright 2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sauls\Component\Xkcd\Api\Client;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Sauls\Component\Xkcd\Api\Exception\ComicNotFoundException;
use Sauls\Component\Xkcd\Api\Exception\ServiceDownException;
use Sauls\Component\Xkcd\Api\Exception\XkcdClientException;

class ClientTest extends ClientTestCase
{
    /**
     * @test
     */
    public function should_retrieve_latest_comic(): void
    {
        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willReturn($this->createXkcdResponse(200));
        $client = $this->createClient([], $guzzleHttpClient);
        $this->assertInfo($client->getLatest());
    }

    /**
     * @test
     */
    public function should_retrieve_latest_comic_using_cache(): void
    {
        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willReturn($this->createXkcdResponse(200));
        $client = $this->createClientWithCache([], $guzzleHttpClient);

        $this->assertInfo($client->getLatest());

        $guzzleHttpClient->expects($this->never())->method('get');

        $this->assertInfo($client->getLatest());
    }

    /**
     * @test
     */
    public function should_retrieve_concrete_comic(): void
    {
        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willReturn($this->createXkcdResponse(200, ['num' => 614]));
        $client = $this->createClient([], $guzzleHttpClient);

        $info = $client->get(614);

        $this->assertSame(614, $info->getNum());
        $this->assertInfo($info);
    }

    /**
     * @test
     */
    public function should_retrieve_concrete_comic_using_cache(): void
    {
        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willReturn($this->createXkcdResponse(200, ['num' => 614]));
        $client = $this->createClientWithCache([], $guzzleHttpClient);


        $info = $client->get(614);
        $this->assertSame(614, $info->getNum());
        $this->assertInfo($info);

        $guzzleHttpClient->expects($this->never())->method('get');

        $info = $client->get(614);
        $this->assertSame(614, $info->getNum());
        $this->assertInfo($info);
    }

    /**
     * @test
     */
    public function should_retrieve_random_comic(): void
    {
        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->expects($this->at(0))->method('get')->willReturn($this->createXkcdResponse(200));
        $guzzleHttpClient->expects($this->at(1))->method('get')->willReturn($this->createXkcdResponse(200,
            ['num' => 915]));

        $client = $this->createClient([], $guzzleHttpClient);

        $guzzleHttpClient->expects($this->exactly(2))->method('get');

        $info = $client->getRandom();
        $this->assertSame(915, $info->getNum());
        $this->assertInfo($info);
    }

    /**
     * @test
     */
    public function should_throw_comic_not_found_exception()
    {
        $this->expectException(ComicNotFoundException::class);
        $this->expectExceptionMessage('Comic not found.');

        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willThrowException(new ClientException('Not found.', new Request('GET', ''),
            new Response(404)));

        $client = $this->createClient([], $guzzleHttpClient);

        $client->getLatest();
    }

    /**
     * @test
     */
    public function should_throw_comic_service_down_exception()
    {
        $this->expectException(ServiceDownException::class);
        $this->expectExceptionMessage('Xkcd service is down.');

        $guzzleHttpClient = $this->getMockBuilder(GuzzleHttpClient::class)->setMethods(['get'])->getMock();
        $guzzleHttpClient->method('get')->willThrowException(new ClientException('Bad response from the server.',
            new Request('GET', ''), new Response(403)));

        $client = $this->createClient([], $guzzleHttpClient);

        $client->getLatest();

    }

    /**
     * @test
     */
    public function should_create_default_guzzle_http_client()
    {
        $this->expectException(XkcdClientException::class);
        $this->expectExceptionMessage('Error occured.');
        $client = $this->createClient(['http_client' => ['base_uri' => 'http://127.0.0.1']]);
        $client->getLatest();
    }
}
