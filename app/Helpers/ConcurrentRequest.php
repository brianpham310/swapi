<?php


namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;

class ConcurrentRequest
{
    protected $client;

    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Send concurrent get requests to $urls
     * @param $urls
     * @param $callbackFunc
     * @return Pool
     */
    public function getPool($urls, $callbackFunc)
    {
        $numberOfRequests = count($urls);
        $client = $this->client;
        // create async requests
        $requests = function ($numberOfRequests) use ($client, $urls) {
            foreach ($urls as $url) {
                yield function () use ($client, $url) {
                    return $client->getAsync($url);
                };
            }
        };
        // send async requests
        return new Pool($client, $requests($numberOfRequests), [
            'concurrency' => $numberOfRequests,
            'fulfilled' => function (Response $response, $index) use ($callbackFunc) {
                $body = $response->getBody();
                $body = json_decode($body, true);
                // process result
                $callbackFunc($body);
            },
            'rejected' => function (RequestException $reason, $index) {
            },
        ]);
    }
}
