<?php declare(strict_types=1);

namespace Ihor\Storefront\Core\Content\Example\SalesChannel;

use Shopware\Core\Framework\DataAbstractionLayer\Search\AggregationResult\Metric\CountResult;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class ProductCountRouteResponse extends StoreApiResponse
{
    public function __construct(
        private readonly CountResult $countResult
    ) {
        parent::__construct($countResult);
    }

    public function getProductCount(): CountResult
    {
        return $this->countResult;
    }
}