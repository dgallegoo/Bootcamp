<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Api\Data;

/**
 * Bookmark interface.
 * @api
 * @since 1.0.0
 */
interface BookmarkInterface
{
    const ID = 'id';
    const CUSTOMER_ID = 'customer_id';
    const CUSTOMER_NAME = 'customer_name';
    const URL_PAGE = 'url_page';
    const PAGE_TITLE = 'page_title';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getCustomerId() : int;

    /**
     * @param int $customer_id
     * @return $this
     */
    public function setCustomerId(int $customer_id) : self;

    /**
     * @return string
     */
    public function getCustomerName(): string;

    /**
     * @param string $customer_name
     * @return $this
     */
    public function setCustomerName(string $customer_name) : self;

    /**
     * @return string
     */
    public function getUrlPage() : string;

    /**
     * @param string $url_page
     * @return $this
     */
    public function setUrlPage(string $url_page) : self;

    /**
     * @return string
     */
    public function getPageTitle() : string;

    /**
     * @param string $page_title
     * @return $this
     */
    public function setPageTitle(string $page_title) : self;

}
