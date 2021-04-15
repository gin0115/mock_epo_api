<?php

declare(strict_types=1);

namespace App\Domain\Category;

use stdClass;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use App\Domain\Category\Category;
use App\Application\Client\RestDBClient;
use App\Domain\Category\CategoryNotFoundException;

class CategoryRespoitory
{
    /** @var Client */
    protected $client;
    
    /** @var LoggerInterface */
    protected $logger;

    public function __construct(RestDBClient $client_factory, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->client = $client_factory->client();
    }
    
    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        $body = (string) $this->client->get('categories')->getBody();
        
        // Return empty array if no body
        if (\mb_strlen($body) === 0) {
            $this->logger->error("Found no categories (findAll) when querying restDB");
            return [];
        }

        try {
            $categories = json_decode($body);
        } catch (\Throwable $th) {
            $this->logger->error("Invalid JSON paypload for categories (findAll) when querying restDB");
            $categories = [];
        }
        
        return $categories;
    }

    /**
     * @param int $id
     * @return stdClass|null
     * @throws CategoryNotFoundException
     */
    public function findCategoryOfId(int $id): ?stdClass
    {
        $body = (string) $this->client->get("categories", ['query' =>  ['q' => json_encode(['id' => $id])]])->getBody();
       
         // Return empty array if no body
        if (\mb_strlen($body) === 0) {
            $this->logger->error("Category with id of {$id} not found in restDB");
            return null;
        }

        try {
            $categories = json_decode($body);
        } catch (\Throwable $th) {
            $this->logger->error("Invalid JSON paypload for categories (find id of {$id}) when querying restDB");
            return null;
        }
        
        return count($categories) > 0 ? $categories[0] : null;
    }
}
