<?php declare(strict_types=1);

    namespace Bootcamp\BookmarkCustomer\Model;

    use Bootcamp\BookmarkCustomer\Api\BookmarkRepositoryInterface;
    use Bootcamp\BookmarkCustomer\Api\Data\BookmarkInterface;
    use Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark as BookmarkResourceModel;
    use Bootcamp\BookmarkCustomer\Model\ResourceModel\Bookmark\CollectionFactory;
    use Magento\Framework\Exception\CouldNotDeleteException;
    use Magento\Framework\Exception\CouldNotSaveException;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Framework\Exception\NoSuchEntityException;
    use Magento\Customer\Helper\Session\CurrentCustomer;


    class BookmarkRepository implements BookmarkRepositoryInterface
    {
        public function __construct(
            private BookmarkFactory            $factory,
            private BookmarkResourceModel      $resourceModel,
            private readonly CollectionFactory $collectionFactory,
            private readonly CurrentCustomer $currentCustomer
        )
        {
        }

        public function save(BookmarkInterface $bookmark): BookmarkInterface
        {
            try {
                $customerId = ((int)$this->currentCustomer->getCustomerId());
                $bookmark->setCustomerId($customerId);
                $this->resourceModel->save($bookmark);
            } catch (\Exception $exception) {
                throw new CouldNotSaveException(__($exception->getMessage()));
            }

            return $bookmark;
        }

        public function getById(int $id): BookmarkInterface
        {
            $bookmark = $this->factory->create();
            $this->resourceModel->load($bookmark, $id);

            if (!$bookmark->getId()) {
                throw new NoSuchEntityException(__('Bookmark ID "%1" doesn\'t exist.', $id));
            }

            return $bookmark;
        }

        public function deleteById(int $id): bool
        {
            $record = $this->getById($id);

            try {
                $this->resourceModel->delete($record);
            } catch (\Exception $exception) {
                throw new CouldNotDeleteException(__($exception->getMessage()));
            }

            return true;
        }

        public function getCollectionByCustomerId(int $customer_id): array
        {
            $collection = $this->collectionFactory->create();
            return $collection->setCustomerIdFilter($customer_id)->getItems();
        }

        public function getByUrlPage(string $urlPage): int
        {

            $currentCustomerId = ((int)$this->currentCustomer->getCustomerId());
            $customerBookmarks =  $this->getCollectionByCustomerIdAndUrlPage($currentCustomerId, $urlPage);
            $bookmarkId = 0;
            if (!empty($customerBookmarks)) {
                $bookmarkId = (int)reset($customerBookmarks)->getData()['id'];
            }

            return $bookmarkId;
        }

        public function getCollectionByCustomerIdAndUrlPage(int $customerId, string $urlPage): array
        {
            $collection = $this->collectionFactory->create();
            return $collection->setCustomerIdFilter($customerId)->setUrlPageToFilter($urlPage)->getItems();
        }

        /**
         * @throws LocalizedException
         */
        public function getBookmarksByCustomer(): array
        {
            $customerId =((int)$this->currentCustomer->getCustomerId());

            return $this->getCollectionByCustomerId($customerId);
        }
    }
