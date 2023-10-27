<?php declare(strict_types=1);
namespace Bootcamp\ProductBadge\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\ResourceModel\Attribute;
use Magento\Catalog\Api\Data\ProductAttributeInterface;

class ProductBagdeAttribute implements DataPatchInterface
{
    const ATTRIBUTE_CODE = 'is_new';

    private Attribute $attribute;
    private Config $config;
    private EavSetupFactory $eavSetupFactory;
    private ModuleDataSetupInterface $moduleDataSetup;

    public function __construct(
        Attribute $attribute,
        Config $config,
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->attribute = $attribute;
        $this->config = $config;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies() : array
    {
        return [];
    }

    public function getAliases()  : array
    {
        return [];
    }

    public function apply() : self
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            self::ATTRIBUTE_CODE,
            [
                'type' => 'int',
                'label' => 'New',
                'input' => 'select',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'required' => false,
                'default' => 0,
                'system' => false,
                'is_used_in_grid' => 1,
                'is_global' => 1,
            ]
        );
        $attribute = $this->config->getAttribute(
            ProductAttributeInterface::ENTITY_TYPE_CODE,
            self::ATTRIBUTE_CODE
        );
        $attribute->setData('used_in_forms', [
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address',
        ]);
        $this->attribute->save($attribute);

        return $this;
    }
}
