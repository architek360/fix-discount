<?php
/**
 * Extension for magento, is used to add fixed discount to order
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    SLV
 * @package     SLV_FixDiscount
 * @copyright   Copyright (c) 2013 Sergey Petrov (sergoslav@gmail.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE sales_flat_order ADD fix_discount_amount decimal(12,4) NOT NULL DEFAULT '0.0000' COMMENT 'Fix Discount amount';
    ALTER TABLE sales_flat_quote ADD fix_discount_amount decimal(12,4) NOT NULL DEFAULT '0.0000' COMMENT 'Fix Discount amount';
    ");

//$installer->getConnection()->addColumn($installer->getTable('sales/quote'), 'fix_discount_amount', 'NOT NULL DEFAULT 0.0000');
//$installer->getConnection()->addColumn($installer->getTable('sales/order'), 'fix_discount_amount', 'NOT NULL DEFAULT 0.0000');

$installer->endSetup();
