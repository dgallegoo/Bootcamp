<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark;

use Bootcamp\BookmarkCustomer\Api\Data\BookmarkInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Bootcamp\BookmarkCustomer\Model\Bookmark;
use Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark as BookmarkResource;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Bookmark::class, BookmarkResource::class);
    }

    public function setCustomerIdFilter($customerId): self
    {
        $this->addFieldToFilter(BookmarkInterface::CUSTOMER_ID, $customerId);
        return $this;
    }
}
