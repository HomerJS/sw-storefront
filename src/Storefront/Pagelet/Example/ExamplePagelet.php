<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Pagelet\Example;

use Shopware\Storefront\Pagelet\Pagelet;

class ExamplePagelet extends Pagelet
{
    protected string $exampleData;

    public function getExampleData(): string
    {
        return $this->exampleData;
    }

    public function setExampleData(string $exampleData): void
    {
        $this->exampleData = $exampleData;
    }
}