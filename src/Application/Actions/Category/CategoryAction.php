<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Category\CategoryMapper;
use App\Domain\Category\CategoryRespoitory;

abstract class CategoryAction extends Action
{
    /**
     * @var CategoryRespoitory
     */
    protected $categoryRepository;
    
    /**
     * @var CategoryMapper
     */
    protected $categoryMapper;

    /**
     * @param LoggerInterface $logger
     * @param CategoryRespoitory $categoryRepository
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryRespoitory $categoryRepository,
        CategoryMapper $categoryMapper
    ) {
        parent::__construct($logger);
        $this->categoryRepository = $categoryRepository;
        $this->categoryMapper = $categoryMapper;
    }
}
