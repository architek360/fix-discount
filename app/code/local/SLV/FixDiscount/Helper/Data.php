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

class SLV_FixDiscount_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XPATH_CONFIG_FIXDISCOUNT_ACTIVE = 'fixdiscount/fixdiscount/active';
    const XPATH_CONFIG_FIXDISCOUNT_COUON_CODE = 'fixdiscount/fixdiscount/coupon_code';

}
