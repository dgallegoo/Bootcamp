<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark;

use Bootcamp\BookmarkCustomer\Api\Data\BookmarkInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Bootcamp\BookmarkCustomer\Model\Bookmark;
use Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark as BookmarkResource;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Collection extends AbstractCollection
{
    protected function __construct(
            private readonly EntityFactoryInterface $entityFactory,
        private readonly LoggerInterface $logger,
        private readonly FetchStrategyInterface $fetchStrategy,
        private readonly ManagerInterface $eventManager,
        private readonly StoreManagerInterface $storeManager,
        private readonly ?AdapterInterface $connection = null,
        private readonly ?AbstractDb $resource = null
    )
    {
        $this->_init(Bookmark::class, BookmarkResource::class);
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    public function setCustomerIdFilter($customerId): self
    {
        $this->addFieldToFilter(BookmarkInterface::CUSTOMER_ID, $customerId);
        return $this;
    }

    public function setUrlPageToFilter($url): self
    {
        $this->addFieldToFilter(BookmarkInterface::URL_PAGE, $url);
        return $this;
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinInner(
            ['secondTable' => $this->getTable('customer_entity')],
            'main_table.customer_id = secondTable.entity_id',
            [
                'main_table.id',
                'main_table.customer_id',
                "CONCAT(secondTable.firstname, ' ', secondTable.lastname) as customer_name",
                'main_table.page_title',
                'main_table.url_page'
            ]
        );

        $this->getSelect()->columns('CONCAT(secondTable.firstname," ",secondTable.lastname) as customer_name');
        $this->addFilterToMap('customer_name', "CONCAT(secondTable.firstname, ' ', secondTable.lastname) as customer_name");

        return $this;
    }
}
