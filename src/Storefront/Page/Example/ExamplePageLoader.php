<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Page\Example;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class ExamplePageLoader
{
    public function __construct(
        private GenericPageLoaderInterface $genericPageLoader,
        private EventDispatcherInterface   $eventDispatcher
    ) {
    }

    public function load(Request $request, SalesChannelContext $context): ExamplePage
    {
        $page = $this->genericPageLoader->load($request, $context);
        $page = ExamplePage::createFrom($page);

        // Do additional stuff, e.g. load more data from store api and add it to page
        $a = [
            'one' => 1,
            'two' => 2,
        ];
        $page->setExampleData($a);

        $this->eventDispatcher->dispatch(
            new ExamplePageLoadedEvent($page, $context, $request)
        );

        return $page;
    }
}