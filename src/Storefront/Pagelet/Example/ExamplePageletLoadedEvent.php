<?php declare(strict_types=1);

namespace Ihor\Storefront\Storefront\Pagelet\Example;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Pagelet\PageletLoadedEvent;
use Symfony\Component\HttpFoundation\Request;

class ExamplePageletLoadedEvent extends PageletLoadedEvent
{
    public function __construct(
        private readonly ExamplePagelet $pagelet,
        SalesChannelContext             $salesChannelContext,
        Request                         $request
    ) {
        parent::__construct($salesChannelContext, $request);
    }

    public function getPagelet(): ExamplePagelet
    {
        return $this->pagelet;
    }
}