<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Controller\Adminhtml\AllCustomersBookmarks;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class View extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Bootcamp_BookmarkCustomer::all_customers_bookmarks_view';

    /** @var PageFactory */
    protected $pageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Bootcamp_BookmarkCustomer::all_customers_bookmarks');
        $page->getConfig()->getTitle()->prepend(__('Bookmark View'));

        return $page;
    }
}
