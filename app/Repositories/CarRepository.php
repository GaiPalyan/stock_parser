<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Car\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarRepository implements CarRepositoryInterface
{
    /**
     * First remove records that are not present in the import data
     * Then update existing records or create new once
     *
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
     * Create single record
     *
     * @param array $car
     * @return void
     */
    public function importCar(array $car)
    {
        Car::updateOrCreate(['car_id' => $car['car_id']], $car);
    }

    /**
     * Update existing records or create new ones
     *
     * @param array $collection
     * @return void
     */
    private function updateOrInsert(array $collection): void
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
    private function delete(array $carIds)
    {
        Car::whereNotIn('car_id', $carIds)->delete();
    }
}
