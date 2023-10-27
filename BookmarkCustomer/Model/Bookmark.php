<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Model;

use Bootcamp\BookmarkCustomer\Api\Data\BookmarkInterface;
use Magento\Framework\Model\AbstractModel;

class Bookmark extends AbstractModel implements BookmarkInterface
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Bookmark::class);
    }

    public function getCustomerId(): int
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function setCustomerId(int $customer_id): BookmarkInterface
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    public function getCustomerName(): string
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    public function setCustomerName(string $customer_name): BookmarkInterface
    {
        return $this->setData(self::CUSTOMER_NAME, $customer_name);
    }

    public function getUrlPage(): string
    {
        return $this->getData(self::URL_PAGE);
    }

    public function setUrlPage(string $url_page): BookmarkInterface
    {
        return $this->setData(self::URL_PAGE, $url_page);
    }

    public function getPageTitle(): string
    {
        return $this->getData(self::PAGE_TITLE);
    }

    public function setPageTitle(string $page_title): BookmarkInterface
    {
        return $this->setData(self::PAGE_TITLE, $page_title);
    }
}
