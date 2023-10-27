<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Controller\CustomerBookmarks;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{

    public function __construct(
        private readonly PageFactory $pageFactory
    ){}

    public function execute(): Page
    {

        $page = $this->pageFactory->create();
        return $page;
    }
}
