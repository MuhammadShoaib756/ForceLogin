<?php

namespace PHPStudios\ForceLogin\Plugin\Cart;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\Checkout\Controller\Cart\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Checkout\Controller\Cart\Index $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CART))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
