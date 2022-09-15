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

    public function __construct(string $filepath)
    {
        $this->elements = simplexml_load_file($filepath);
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function toArray(SimpleXMLElement $offers): array
    {
        return json_decode(json_encode($offers), true);
    }

    /**
     * @return array $offers
     * @throws \Exception
     */
    public function getOfferList(): array
    {
        return $this->toArray($this->elements->offers);
    }

    public function getCount(): int
    {
        return $this->elements->children()->children()->count();
    }
}
