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


class SLV_FixDiscount_Model_Quote_Discount extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    public function __construct()
    {
        $this->setCode('custom_fix_discount');
    }

    /**
     * Collect fixed discount totals for specified address
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return SLV_FixDiscount_Model_Quote_Discount
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $quote = $address->getQuote();
        $fixedDiscountAmount = $quote->getFixDiscountAmount();

//        $discountDescription = $address->getDiscountDescription();
//        Mage::log($discountDescription, null, 'debug_$discountDescription.log');
//        $discountDescription[0] = 'Custom';
//        $address->setDiscountDescription($discountDescription.', Custom');

        if ($fixedDiscountAmount!=0 && !Mage::registry('slv_add_fixed_discount_amount')) {
            $address->setBaseGrandTotal($address->getBaseGrandTotal()-$fixedDiscountAmount);
            $address->setGrandTotal($address->getGrandTotal()-$fixedDiscountAmount);

            Mage::register('slv_add_fixed_discount_amount',true);
        }

        return $this;
    }

    /**
     * Add discount total information to address
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  SLV_FixDiscount_Model_Quote_Discount
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $quote = $address->getQuote();
        $amount = $quote->getFixDiscountAmount();

        if ($amount!=0 && !Mage::registry('slv_add_fixed_discount')) {
            $description = 'Fixed Discount';
            if ($description) {
//                $title = Mage::helper('sales')->__('Discount (%s)', $description);
                $title = Mage::helper('sales')->__($description);
            } else {
//                $title = Mage::helper('sales')->__('Discount');
                $title = Mage::helper('sales')->__($description);
            }
            $address->addTotal(array(
                'code'  => $this->getCode(),
                'title' => $title,
                'value' => -$amount
            ));
            Mage::register('slv_add_fixed_discount',true);
        }
        return $this;
    }

}
