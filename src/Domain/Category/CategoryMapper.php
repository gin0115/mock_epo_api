<?php

declare(strict_types=1);

namespace App\Domain\Category;

use stdClass;

class CategoryMapper
{

    /**
     * Populates a category from a restDB result.
     *
     * @param \stdClass $catgory
     * @return Category
     */
    public function fromRestDB(stdClass $catgory): Category
    {
        $parent = is_array($catgory->parent) && ! empty($catgory->parent)
            ? $catgory->parent[0]->id : null ;

        return new Category(
            $catgory->id,
            $catgory->name,
            $catgory->cat_ref,
            $parent,
            $catgory->description,
            $catgory->image
        );
    }
}
