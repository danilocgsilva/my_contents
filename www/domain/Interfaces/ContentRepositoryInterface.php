<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\Interfaces\PaginatableInterface;
use Domain\Content;

interface ContentRepositoryInterface extends PaginatableInterface
{
    /**
     * Return all models registers.
     *
     * @return Content[]
     */
    public function all(): array;

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return Content|null
     */
    public function find(int $id): ?Content;

    /**
     * Insert a new entry in the table contents.
     * No need to set a content data.
     */
    public function create(): Content;

    /**
     * Removes a register by its id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get the create database id
     * 
     * @return void
     */
    public function getCreatedId(): int;

    /**
     * Save the content to the database
     * 
     * @param Content $content
     * @return void
     */
    public function save(Content $content): void;

    /**
     * When retrieving contents, records the content's database ids as well.
     * 
     * @return void
     */
    public function rememberIds(): self;
}
