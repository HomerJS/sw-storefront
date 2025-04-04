<?php declare(strict_types=1);

namespace Ihor\Storefront\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\Product\SalesChannel\Sorting\ProductSortingDefinition;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Uuid\Uuid;

class Migration1743785178AddSorting extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1743785178;
    }

    public function update(Connection $connection): void
    {
        $myCustomSorting = [
            'id' => Uuid::randomBytes(),
            'url_key' => 'my-custom-sort',  // shown in url - must be unique system wide
            'priority' => 5,                // the higher the priority, the further upwards it will be shown in the sortings dropdown in Storefront
            'active' => 1,                  // activate / deactivate the sorting
            'locked' => 0,                  // you can lock the sorting here to prevent it from being edited in the Administration
            'fields' => json_encode([
                [
                    'field' => 'product.name',  // field to sort by
                    'order' => 'desc',          // asc or desc
                    'priority' => 1,            // in which order the sorting is to applied (higher priority comes first)
                    'naturalSorting' => 0       // apply natural sorting logic to this field
                ],
            ]),
            'created_at' => (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT),
        ];

        // insert the product sorting
        $connection->insert(ProductSortingDefinition::ENTITY_NAME, $myCustomSorting);

        // insert the translation for the translatable label
        // if you use multiple languages, you will need to update all of them
        $connection->executeStatement(
            'REPLACE INTO product_sorting_translation
             (`language_id`, `product_sorting_id`, `label`, `created_at`)
             VALUES
             (:language_id, :product_sorting_id, :label, :created_at)',
            [
                'language_id' => Uuid::fromHexToBytes(Defaults::LANGUAGE_SYSTEM),
                'product_sorting_id' => $myCustomSorting['id'],
                'label' => 'My Custom Sorting',
                'created_at' => (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT),
            ]
        );
    }
}
