<?php

declare(strict_types=1);

namespace App\Domain\News;

use App\Domain\New\News;
use App\Domain\New\NewsNotFoundException;

interface NewsRepositoryInterface
{
    /**
     * @return News[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return News
     * @throws NewsNotFoundException
     */
    public function findUserOfId(int $id): News;


    /**
     * Delete a news
     *
     * @throws Exception
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * Delete a news
     *
     * @throws Exception
     * @param News $news
     * @return void
     */
    public function add(News $news): void;

    /**
     * Update  a news
     *
     * @throws Exception
     * @param News $news
     * @return void
     */
    public function update(News $news): void;
}
