<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Bootcamp\BookmarkCustomer\Api\BookmarkRepositoryInterface;

class SectionBookmark implements SectionSourceInterface
{
    public function __construct(
        private readonly BookmarkRepositoryInterface $repository,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getSectionData(): array
    {
        $bookmarks = $this->repository->getCurrentCustomerBookmarks();
        $data = [];
        foreach ($bookmarks as $bookmark) {
            $data[] = $bookmark->getData();
        }

        return $data;
    }
}
