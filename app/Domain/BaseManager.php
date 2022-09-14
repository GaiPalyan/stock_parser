<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Car\CarManager;
use App\Domain\Car\CarRepositoryInterface;

class BaseManager
{
    /*private $managers = [
        'auto-catalog' => CarManager::class,
    ];

    private BaseRepositoryInterface $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getManager(string $catalogName)
    {
        return new $this->managers[$catalogName]($this->repository);
    }*/
}
