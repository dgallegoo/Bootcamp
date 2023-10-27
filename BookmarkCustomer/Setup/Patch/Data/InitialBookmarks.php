<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Setup\Patch\Data;

use Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialBookmarks implements DataPatchInterface
{
    public function __construct(
        private readonly ResourceConnection $resourceConnection
    ){}

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply(): self
    {
        $connection = $this->resourceConnection->getConnection();
        $data = [
            [
                'customer_id' => 2,
                'customer_name' => 'Diana Gallego',
                'url_page' => 'https://magento.test/women/bottoms-women/pants-women.html',
                'page_title' => 'Pants Women'
            ],
            [
                'customer_id' => 2,
                'customer_name' => 'Diana Gallego',
                'url_page' => 'https://magento.test/training.html',
                'page_title' => 'Training'
            ],
            [
                'customer_id' => 2,
                'customer_name' => 'Diana Gallego',
                'url_page' => 'https://bootcamp.test/gear/fitness-equipment.html',
                'page_title' => 'Fitness Equipment'
            ],

            [
                'customer_id' => 1,
                'customer_name' => 'Veronica Costello',
                'url_page' => 'https://bootcamp.test/training/training-video.html',
                'page_title' => 'Training Video'
            ],

            [
                'customer_id' => 1,
                'customer_name' => 'Veronica Costello',
                'url_page' => 'https://bootcamp.test/women.html',
                'page_title' => 'Women'
            ],


        ];

        $connection->insertMultiple(Bookmark::MAIN_TABLE, $data);

        return $this;
    }
}
