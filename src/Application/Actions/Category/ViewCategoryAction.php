<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Category\CategoryAction;

class ViewCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $categoryId = (int) $this->resolveArg('id');
        $category = $this->categoryRepository->findCategoryOfId($categoryId);

        $this->logger->info("Category of id `${categoryId}` was viewed.");

        return $category
                ? $this->respondWithData($this->categoryMapper->fromRestDB($category))
                : $this->respondWithData([], 404);
    }
}
