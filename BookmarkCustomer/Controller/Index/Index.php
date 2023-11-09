<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
class Index implements HttpGetActionInterface
{
    const BOOKMARK_SETTING = 'bookmark/options/active';
    public function __construct(
        private readonly PageFactory $pageFactory,
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly ResultFactory $resultFactory,
    ){}

    public function execute()
    {
        $page = $this->pageFactory->create();
        $value = $this->scopeConfig->getValue(self::BOOKMARK_SETTING);

        if ($value &&  $value == "1") {
            return $page;
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('customer/account');
    }
}
