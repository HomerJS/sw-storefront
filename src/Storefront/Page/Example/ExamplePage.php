<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Page\Example;

use Shopware\Storefront\Page\Page;

class ExamplePage extends Page
{
    protected array $exampleData;

    public function getExampleData(): array
    {
        return $this->exampleData;
    }

    public function setExampleData(array $exampleData = []): void
    {
        $this->exampleData = $exampleData;
    }
}