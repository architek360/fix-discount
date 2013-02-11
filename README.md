<form id="discount-fixed-form" action="<?php echo $this->getUrl('checkout/cart/discountFix') ?>" method="post">
    <div class="discount">
        <h2><?php echo $this->__('Fixed Discount') ?></h2>
        <div class="discount-form">
            <label for="coupon_code_fix"><?php echo $this->__('Enter your discount amount.') ?></label>
            <input type="hidden" name="remove" id="remove-coupone-fix" value="0" />
            <div class="input-box">
                <input class="input-text" id="coupon_code_fix" name="fixed_coupon_code" value="<?php echo $this->htmlEscape(Mage::getSingleton('checkout/session')->getFixdisc()) ?>" />
            </div>
            <div class="buttons-set">
                <button type="button" title="<?php echo $this->__('Apply Discount') ?>" class="button" onclick="discountForm2.submit(false)" value="<?php echo $this->__('Apply Discount') ?>"><span><span><?php echo $this->__('Apply Discount') ?></span></span></button>
            </div>
        </div>
    </div>
</form>
