<?php

declare(strict_types=1);

namespace App\Services;

class OfferTransformer
{
    /**
     * @param array $offerList
     * @return array $offers
     */
    public function transformCollection(array $offerList): array
    {

        $offers = [];

        foreach ($offerList as $offer) {
            $offers[] = $this->transform($offer);
        }

        return $offers;
    }

    /**
     * @param array $offer
     * @return array $offerParams
     */
    public function transform(array $offer): array
    {
        $offerParams = [];

        foreach ($offer as $offerKey => $offerValue) {
            if (empty($offerValue)) {
                $offerParams[$offerKey] = null;
                continue;
            }

            if ($offerKey === 'id') {
                $offerParams[str_replace('id', 'car_id', $offerKey)] = $offerValue;
                continue;
            }

            $offerParams[str_replace('-', '_', $offerKey)] = $offerValue;
        }

        return $offerParams;
    }
}
