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

class SLV_FixDiscount_Model_Observer
{

    /**
     * @param $observer sales_model_service_quote_submit_after
     */
    public function sales_model_service_quote_submit_after($observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $fixedDiscountAmount = $quote->getFixDiscountAmount();

        if ($fixedDiscountAmount != 0){
            $order = $observer->getEvent()->getOrder();

            $order->setFixDiscountAmount($fixedDiscountAmount);

            $addDiscountDescription = $order->getDiscountDescription();
            if ($addDiscountDescription){
                $addDiscountDescription .= ', ';
            }
            $addDiscountDescription .= Mage::getStoreConfig(SLV_FixDiscount_Helper_Data::XPATH_CONFIG_FIXDISCOUNT_COUON_CODE);

            $order->setDiscountDescription($addDiscountDescription);

            $order->setDiscountAmount($order->getDiscountAmount() - $fixedDiscountAmount);
            $order->setBaseDiscountAmount($order->getBaseDiscountAmount() - $fixedDiscountAmount);
            $order->setGiftCardsAmount($order->getGiftCardsAmount() - $fixedDiscountAmount);

            $order->save();
        }

    }
}

