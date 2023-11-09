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

    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    public function setCustomerName($customer_name)
    {
        return $this->setData(self::CUSTOMER_NAME, $customer_name);
    }

    public function getUrlPage()
    {
        return $this->getData(self::URL_PAGE);
    }

    public function setUrlPage($url_page)
    {
        return $this->setData(self::URL_PAGE, $url_page);
    }

    public function getPageTitle()
    {
        return $this->getData(self::PAGE_TITLE);
    }

    public function setPageTitle($page_title)
    {
        return $this->setData(self::PAGE_TITLE, $page_title);
    }
}
