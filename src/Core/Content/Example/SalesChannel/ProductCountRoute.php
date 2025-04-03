<?php declare(strict_types=1);

namespace Ihor\Storefront\Core\Content\Example\SalesChannel;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Aggregation\Metric\CountAggregation;
use Shopware\Core\Framework\DataAbstractionLayer\Search\AggregationResult\Metric\CountResult;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin\Exception\DecorationPatternException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: ['_routeScope' => ['store-api']])]
class ProductCountRoute extends AbstractProductCountRoute
{
    public function __construct(
        private readonly EntityRepository $productRepository
    ) {
    }

    public function getDecorated(): AbstractProductCountRoute
    {
        throw new DecorationPatternException(self::class);
    }

    #[Route(path: '/store-api/get-active-product-count', name: 'store-api.product-count.get', defaults: ['_entity' => 'product'], methods: ['GET', 'POST'])]
    public function load(Criteria $criteria, SalesChannelContext $context): ProductCountRouteResponse
    {
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('product.active', true));
        $criteria->addAggregation(new CountAggregation('productCount', 'product.id'));

        /** @var CountResult $productCountResult */
        $productCountResult = $this->productRepository
            ->aggregate($criteria, $context->getContext())
            ->get('productCount');

        return new ProductCountRouteResponse($productCountResult);
    }
}