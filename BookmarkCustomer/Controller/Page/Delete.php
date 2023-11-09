<?php

namespace Bootcamp\BookmarkCustomer\Controller\Page;

use Bootcamp\BookmarkCustomer\Api\BookmarkRepositoryInterface;
use Bootcamp\BookmarkCustomer\Model\BookmarkFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    protected $resultPageFactory;
    protected $bookmarkFactory;
    protected $bookmarkRepository;

    protected $customerSession;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BookmarkFactory $bookmarkFactory,
        BookmarkRepositoryInterface $bookmarkRepository,
        Session $customerSession,
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository=$bookmarkRepository;
        $this->customerSession=$customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id', false);

            if ($id) {
                try {
                    if ($this->bookmarkRepository->getById($id)) {
                        $this->bookmarkRepository->deleteById($id);
                        $this->messageManager->addSuccessMessage(__('You deleted the bookmark.'));
                    } else {
                        $this->messageManager->addErrorMessage(__('We can\'t delete the bookmark right now.'));
                    }
                } catch (\Exception $other) {
                    $this->messageManager->addException($other, __('We can\'t delete the Bookmark right now.'));
                }
            }
            return $this->resultRedirectFactory->create()->setPath('*/index/index');


        } catch (\Exception $other) {
            $this->messageManager->addException($other, __('We can\'t delete the Bookmark right now.'));
        }
        return $this->resultRedirectFactory->create()->setPath('*/index/index');
    }
}
