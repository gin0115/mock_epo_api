<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

class ListCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categories = $this->categoryRepository->findAll();

        $this->logger->info("All categories listed  " . date('d/m/Y H:i '));

        return $this->respondWithData(
            array_map([$this->categoryMapper, 'fromRestDB'], $categories)
        );
    }
}
