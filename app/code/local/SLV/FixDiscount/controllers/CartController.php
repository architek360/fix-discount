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

/**
 * Checkout cart controller
 */
require_once 'app/code/core/Mage/Checkout/controllers/CartController.php';
class SLV_FixDiscount_CartController extends Mage_Checkout_CartController
{

    protected function discountFixAction()
    {
        if (!Mage::getStoreConfig(SLV_FixDiscount_Helper_Data::XPATH_CONFIG_FIXDISCOUNT_ACTIVE)) {
            $this->_redirect('checkout/cart');
            return;
        }

        $params = $this->getRequest()->getParams();

        if ($params['remove'] == 1){
            $discountAmount = 0;
            $this->_getSession()->addSuccess($this->__('Fixed discount amount was canceled successfully.'));
            $this->_getQuote()
                ->setFixDiscountAmount($discountAmount)
                ->collectTotals()
                ->save();
        } else {
            $discountAmount = (float)str_replace(',','',$params['fixed_coupon_code']);
            if ($discountAmount > 0) {
                $this->_getSession()->addSuccess(
                    $this->__('Fixed discount amount was applied successfully. Discount amount is "%s"',
                        Mage::helper('core')->currency($discountAmount, true, false))
            );
                $this->_getQuote()
                ->setFixDiscountAmount($discountAmount)
                ->collectTotals()
                ->save();

            } else {
                $this->_getSession()->addError(
                    $this->__('Fixed discount amount not applied! Discount amount must be greater than zero!',
                        Mage::helper('core')->currency($discountAmount, true, false))
                );
            }
        }

        $this->_redirect('checkout/cart');
    }

}
