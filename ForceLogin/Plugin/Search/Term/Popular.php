<?php

namespace PHPStudios\ForceLogin\Plugin\Search\Term;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Popular
 */
class Popular extends ForceLogin
{
    /**
     * @param \Magento\Search\Controller\Term\Popular $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Search\Controller\Term\Popular $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::SEARCH_TERM))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
