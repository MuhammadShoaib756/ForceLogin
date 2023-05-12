<?php

namespace PHPStudios\ForceLogin\Plugin\Index;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\Checkout\Controller\Index\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Checkout\Controller\Index\Index $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CHECKOUT_INDEX))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
