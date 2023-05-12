<?php

namespace PHPStudios\ForceLogin\Plugin\CatalogSearch\Result;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\CatalogSearch\Controller\Result\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\CatalogSearch\Controller\Result\Index $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::SEARCH_RESULT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
