<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Api;

use Bootcamp\BookmarkCustomer\Api\Data\BookmarkInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Bookmark repository interface.
 * @api
 * @since 1.0.0
 */
interface BookmarkRepositoryInterface
{
    /**
     * Save bookmark.
     *
     * @param BookmarkInterface $bookmark
     * @return BookmarkInterface
     * @throws LocalizedException
     */
    public function save(BookmarkInterface $bookmark) : BookmarkInterface;

    /**
     * Retrieve bookmark.
     *
     * @param int $id
     * @return BookmarkInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getById(int $id) : BookmarkInterface;

    /**
     * Delete bookmark.
     *
     * @param int $id
     * @return bool true on success
     * @throws LocalizedException
     */
    public function deleteById(int $id) : bool;

    /**
     * Collection bookmarks by customer.
     *
     * @param int $customer_id
     * @return array customers bookmarks
     * @throws LocalizedException
     */
    public function getCollectionByCustomerId(int $customer_id) : array;


}
