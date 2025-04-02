<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Pagelet\Example;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class ExamplePageletLoader
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function load(Request $request, SalesChannelContext $context): ExamplePagelet
    {
        $pagelet = new ExamplePagelet();

        // Do additional stuff, e.g. load more data from store-api and add it to page
        $pagelet->setExampleData('asdasd');

        $this->eventDispatcher->dispatch(
            new ExamplePageletLoadedEvent($pagelet, $context, $request)
        );

        return $pagelet;
    }
}