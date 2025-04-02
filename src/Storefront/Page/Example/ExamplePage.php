<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Page\Example;

use Ihor\Storefront\Storefront\Pagelet\Example\ExamplePagelet;
use Shopware\Storefront\Page\Page;

class ExamplePage extends Page
{
    protected array $exampleData;
    protected ExamplePagelet $examplePagelet;

    public function getExampleData(): array
    {
        return $this->exampleData;
    }

    public function setExampleData(array $exampleData = []): void
    {
        $this->exampleData = $exampleData;
    }

    public function setExamplePagelet(ExamplePagelet $examplePagelet): void
    {
        $this->examplePagelet = $examplePagelet;
    }

    public function getExamplePagelet(): ExamplePagelet
    {
        return $this->examplePagelet;
    }
}