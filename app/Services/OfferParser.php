<?php

declare(strict_types=1);

namespace App\Services;

use SimpleXMLElement;

class OfferParser
{
    /**
     * @var SimpleXMLElement
     */
    private SimpleXMLElement $elements;

    private array $offerList = [];

    public function __construct(string $filepath)
    {
        $this->elements = simplexml_load_file($filepath);
    }

    public function toJson(): string
    {
        return json_encode($this->elements);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray(): array
    {
        $this->offerList = array_merge(json_decode($this->toJson(), true), $this->offerList);

        if (!array_key_exists('offer', $this->offerList)) {
            throw new \Exception('<offer> param not found in this xml file');
        }

        return $this->transformCollection($this->offerList['offer']);
    }

    /**
     * @param array $offerList
     * @return array
     */
    public function transformCollection(array $offerList): array
    {
        $offerElements = [];

        foreach ($offerList as $offer) {
            $offerElements[] = $this->transform($offer);
        }
        return $offerElements;
    }

    /**
     * @param array $offer
     * @return array
     */
    public function transform(array $offer): array
    {
        $offerElementParams = [];

        foreach ($offer as $offerKey => $offerValue) {
            if (empty($offerValue)) {
                $offerElementParams[$offerKey] = null;
                continue;
            }

            if ($offerKey === 'id') {
                $offerElementParams[str_replace('id', 'car_id', $offerKey)] = $offerValue;
                continue;
            }

            $offerElementParams[str_replace('-', '_', $offerKey)] = $offerValue;
        }


        return $offerElementParams;
    }

    /**
     * @return OfferParser $this
     */
    public function getOfferList(): OfferParser
    {
        $this->setOfferElements();

        return $this;
    }

    public function setOfferElements(): void
    {
        $this->elements = $this->getElements()->offers;
    }

    /**
     * @return SimpleXMLElement $elements
     */
    public function getElements(): SimpleXMLElement
    {
        return $this->elements;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->elements->getName();
    }
}
