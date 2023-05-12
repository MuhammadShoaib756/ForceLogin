<?php

namespace PHPStudios\ForceLogin\Plugin\Category;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class View
 */
class View extends \PHPStudios\ForceLogin\Plugin\ForceLogin
{
    /**
     * @param \Magento\Catalog\Controller\Category\View $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Catalog\Controller\Category\View $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CATEGORY))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
