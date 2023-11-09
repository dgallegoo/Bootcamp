<?php
namespace Bootcamp\BookmarkCustomer\ViewModel;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class BookmarkConfig extends AbstractHelper implements ArgumentInterface
{
    const BOOKMARK_CUSTOMER_CONFIG = 'bookmark/options/active';
    public function getConfig()
    {
    return $this->scopeConfig->getValue( self::BOOKMARK_CUSTOMER_CONFIG, ScopeInterface::SCOPE_STORE );

    }
}
