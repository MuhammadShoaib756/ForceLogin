<?php

namespace PHPStudios\ForceLogin\Plugin\Product;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class View
 */
class View extends ForceLogin
{
    /**
     * @param \Magento\Catalog\Controller\Product\View $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Catalog\Controller\Product\View $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::PRODUCT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
