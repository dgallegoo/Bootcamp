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
    public function getCustomerId();

    /**
     * @param int $customer_id
     * @return $this
     */
    public function setCustomerId($customer_id);

    /**
     * @return string
     */
    public function getCustomerName();

    /**
     * @param string $customer_name
     * @return $this
     */
    public function setCustomerName($customer_name);

    /**
     * @return string
     */
    public function getUrlPage();

    /**
     * @param string $url_page
     * @return $this
     */
    public function setUrlPage($url_page);

    /**
     * @return string
     */
    public function getPageTitle();

    /**
     * @param string $page_title
     * @return $this
     */
    public function setPageTitle($page_title);

}
