<?php declare(strict_types=1);

namespace Bootcamp\BookmarkCustomer\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Escaper;

class Actions extends Column
{
    /** @var UrlInterface */
    protected $urlBuilder;


    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * Actions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            if (!isset($item['id'])) {
                continue;
            }
            $name = $this->getData('name');
            $item[$name]['view'] = [
                'href' => $this->urlBuilder->getUrl('bookmarks/AllCustomersBookmarks/view', [
                    'id' => $item['id'],
                ]),
                'label' => __('View')
            ];
        }

        return $dataSource;
    }

}
