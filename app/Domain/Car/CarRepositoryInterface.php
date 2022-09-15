<?php

declare(strict_types=1);

namespace App\Domain\Car;

use App\Models\Car;

interface CarRepositoryInterface
{
    /**
     * First remove records that are not present in the import data
     * Then update existing records or create new once
     *
     * @param array $collection
     * @return void
     */
    public function importCarsCollection(array $collection): void;

    /**
     * Create single record
     *
     * @param array $car
     * @return mixed
     */
    public function importCar(array $car);
}
