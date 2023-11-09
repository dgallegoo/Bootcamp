<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Bootcamp\BookmarkCustomer\Model\BookmarkRepository;
use Magento\Framework\Exception\LocalizedException;

class BookmarksSection implements SectionSourceInterface
{
    public function __construct(
        private readonly BookmarkRepository $repository,
    ) {}

    /**
     * {@inheritdoc}
     * @throws LocalizedException
     */
    public function getSectionData(): array
    {
        $bookmarks = $this->repository->getBookmarksByCustomer();
        $data = [];
        foreach ($bookmarks as $bookmark) {
            $data[] = $bookmark->getData();
        }

        return $data;
    }
}
