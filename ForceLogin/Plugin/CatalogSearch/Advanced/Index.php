<?php

namespace PHPStudios\ForceLogin\Plugin\CatalogSearch\Advanced;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\CatalogSearch\Controller\Advanced\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\CatalogSearch\Controller\Advanced\Index $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::ADVANCE_SEARCH))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
