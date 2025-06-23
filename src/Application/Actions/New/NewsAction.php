<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\News\NewsRepositoryInterface;
use App\Infrastructure\Persistence\News\NewsRepository;

abstract class NewsAction extends Action
{
    protected NewsRepository $newsRepository;

    public function __construct(LoggerInterface $logger, NewsRepositoryInterface $newsRepository)
    {
        parent::__construct($logger);
        $this->newsRepository = $newsRepository;
    }
}
