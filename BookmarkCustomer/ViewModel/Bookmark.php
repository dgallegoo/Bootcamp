<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\ViewModel;

use Bootcamp\BookmarkCustomer\Api\BookmarkRepositoryInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Bookmark implements ArgumentInterface
{
    public function __construct(
        private readonly CurrentCustomer $currentCustomer,
        private readonly BookmarkRepositoryInterface $repository,
    ) {}
    public function getCustomerList(): array
    {
        $id = (int)$this->currentCustomer->getCustomerId();
        return $this->repository->getCollectionByCustomerId($id);
    }
}
