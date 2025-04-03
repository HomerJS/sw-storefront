<?php declare(strict_types=1);

namespace Ihor\Storefront\Subscriber;

use Ihor\Storefront\Core\Content\Example\SalesChannel\AbstractProductCountRoute;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Storefront\Pagelet\Footer\FooterPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

readonly class AddDataToPageSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private AbstractProductCountRoute $productCountRoute
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FooterPageletLoadedEvent::class => 'addActiveProductCount'
        ];
    }

    public function addActiveProductCount(FooterPageletLoadedEvent $event): void
    {
        $productCountResponse = $this->productCountRoute->load(new Criteria(), $event->getSalesChannelContext());

        $event->getPagelet()->addExtension('product_count', $productCountResponse->getProductCount());
    }
}