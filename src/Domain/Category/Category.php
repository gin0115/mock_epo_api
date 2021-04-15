<?php

declare(strict_types=1);

namespace App\Domain\Category;

use JsonSerializable;

class Category implements JsonSerializable
{
    
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $reference;

    /** @var ?int */
    protected $parent;

    /** @var string */
    protected $description;

    /** @var string|null */
    protected $image;

    public function __construct(
        int $id,
        string $name,
        string $reference,
        ?int $parent,
        string $description,
        ?string $image
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->reference = $reference;
        $this->parent = $parent;
        $this->description = $description;
        $this->image = $image;
    }
    
    /**
     * @return array{id:int,name:string,reference:string,parent:int|null,description:string,image:string|null}
     */
    public function jsonSerialize()
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'reference'    => $this->reference,
            'parent'       => $this->parent ?? 0,
            'description'  => $this->description,
            'image'        => $this->image ?? '',
        ];
    }

    /**
     * Get the value of id
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get the value of reference
     * @return string
     */
    public function reference(): string
    {
        return $this->reference;
    }

    /**
     * Get the value of parent
     * @return int|null
     */
    public function parent(): ?int
    {
        return $this->parent;
    }

    /**
     * Get the value of description
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * Get the value of image
     * @return string|null
     */
    public function image(): ?string
    {
        return $this->image;
    }
}
