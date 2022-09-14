<?php

declare(strict_types=1);

namespace App\Domain\Car;

use App\Domain\BaseManager;

class CarManager extends BaseManager
{
    /**
     * @var CarRepositoryInterface
     */
    private CarRepositoryInterface $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function importOffer(array $offers)
    {
        $this->carRepository->importCarsCollection($offers);
    }
}
