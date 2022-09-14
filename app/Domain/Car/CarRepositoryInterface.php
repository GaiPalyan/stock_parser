<?php

declare(strict_types=1);

namespace App\Domain\Car;

use App\Domain\BaseRepositoryInterface;

interface CarRepositoryInterface extends BaseRepositoryInterface
{
    public function importCarsCollection(array $collection): void;
}
