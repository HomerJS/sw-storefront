<?php declare(strict_types=1);

namespace Ihor\Storefront\Subscriber;

use Shopware\Core\Content\Product\Events\ProductListingCollectFilterEvent;
use Shopware\Core\Content\Product\SalesChannel\Listing\Filter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Aggregation\Bucket\FilterAggregation;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Aggregation\Metric\RangeAggregation;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\RangeFilter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExampleListingSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ProductListingCollectFilterEvent::class => 'addFilter'
        ];
    }

    public function addFilter(ProductListingCollectFilterEvent $event): void
    {
        // fetch existing filters
        $filters = $event->getFilters();
        $request = $event->getRequest();

        $filterValue = $request->get('myFilter');

        // FILTER VARS
        $name = 'myFilter';
        $active = (bool) $filterValue;

        $filterLogic = new RangeFilter('product.weight', [RangeFilter::GTE => $filterValue]);
        $value = $filterValue ?? 0;

        $filter = new Filter(
            // UNIQUE FILTER NAME
            $name,

            // FILTER ACTIVE OR NOT
            $active,

            // AGGREGATION LOGIC
            // IT CAN GROUP PRODUCTS FOR INFORMATION
            // IT WILL BE DISPLAYED IN listing.aggregations.elements
            // IT WILL GET ALL PRODUCTS WITH WEIGHT MORE THAN 0
            // and use AGGREGATION LOGIC

            [
                new FilterAggregation(
                    'my_filter_aggregation',
                    new RangeAggregation('aggrname', 'product.weight', [['from' => 0, 'to' => 0.170], ['from' => 0.171, 'to' => 9999]]),
                    [new RangeFilter('product.weight', [RangeFilter::GTE => 0])]
                ),
            ],


            // FILTER LOGIC
            $filterLogic,

            // defines the values which will be added as currentFilter to the result
            //JUST A VALUE, WHICH WILL BE SET LISTING -> currentFilters
            // DO NOTHING
            $value
        );

        // Add your custom filter
        $filters->add($filter);
    }
}