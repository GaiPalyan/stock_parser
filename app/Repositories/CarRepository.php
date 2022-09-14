<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Car\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarRepository implements CarRepositoryInterface
{
    /**
     * @param array $collection
     * @return void
     */
    public function importCarsCollection(array $collection): void
    {
        $carIds = collect($collection)->pluck('car_id')->sortBy('car_id')->toArray();
        $this->delete($carIds);

        $this->updateOrInsert($collection);
    }

    /**
     *
     *
     * @param array $collection
     * @return void
     */
    public function updateOrInsert(array $collection): void
    {
        DB::transaction(function () use ($collection) {
            foreach ($collection as $car) {
                Car::updateOrCreate(['car_id' => $car['car_id']], $car);
            }
        });
    }

    /**
     * Delete all records that are not in import data
     *
     * @param array $carIds
     * @return void
     */
    public function delete(array $carIds)
    {
        Car::whereNotIn('car_id', $carIds)->delete();
    }
}
