<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\ViewModel;

use Bootcamp\BookmarkCustomer\Api\BookmarkRepositoryInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;

class Bookmark extends Template implements ArgumentInterface
{
    public function __construct(
        private readonly CurrentCustomer $currentCustomer,
        private readonly BookmarkRepositoryInterface $repository,
        Context $context,
        array $data = []
    ) {parent::__construct($context, $data);}
    public function getCustomerList(): array
    {
        $id = (int)$this->currentCustomer->getCustomerId();
        return $this->repository->getCollectionByCustomerId($id);
    }

    public function getDeleteAction() : string
    {
        return $this->getUrl('bookmarks/page/delete/');
    }



}
