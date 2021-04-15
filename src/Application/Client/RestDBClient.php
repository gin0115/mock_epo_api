<?php

declare(strict_types=1);

namespace App\Application\Client;

use GuzzleHttp\Client;

class RestDBClient
{

    /**
     * Returns a client with the passed headers.
     *
     * @param array<mixed> $headers
     * @return \GuzzleHttp\Client
     */
    public function withHeadeaders(array $headers): Client
    {
        return new Client(['base_uri' => $_ENV['RESTDB_URL'], 'header' => $headers]);
    }

    /**
     * Returns and instance of the client with passed options.
     *
     * @param array<mixed> $options
     * @return \GuzzleHttp\Client
     */
    public function withOptions(array $options): Client
    {
        $options['base_url'] = $_ENV['RESTDB_URL'];
        return new Client($options);
    }

    /**
     * Returns a standard client for use with restdb
     * Base uri is populated form ENV
     * Headers (key, type) are populated as JSON and using key from ENV
     *
     * @return \GuzzleHttp\Client
     */
    public function client(): Client
    {
        return new Client([
            'base_uri' => $_ENV['RESTDB_URL'],
            'debug' => $_ENV['GUZZLE_DEBUG'] === 'true',
            'headers' => [
                'cache-control' => 'no-cache',
                'x-apikey' => $_ENV['RESTDB_KEY'],
                'content-type' => 'application/json'
            ]
        ]);
    }
}
