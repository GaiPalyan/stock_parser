<?php

declare(strict_types=1);

namespace App\Domain\Car;
use App\Services\OfferTransformer;

class CarManager
{
    /**
     * @var CarRepositoryInterface
     */
    private CarRepositoryInterface $carRepository;
    private OfferTransformer $offerTransformer;

    public function __construct(CarRepositoryInterface $carRepository, OfferTransformer $offerTransformer)
    {
        $this->carRepository = $carRepository;
        $this->offerTransformer = $offerTransformer;
    }

    /**
     * Dispatch model creation methods by offers count
     *
     * @param array $offers
     * @param int $count
     * @return void
     */
    public function importOffer(array $offers, int $count): void
    {
        if ($count === 1) {
            $car = $this->offerTransformer->transform($offers);
            $this->carRepository->importCar($car);
            return;
        }

        $cars = $this->offerTransformer->transformCollection($offers);
        $this->carRepository->importCarsCollection($cars);
    }
}
