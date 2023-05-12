<?php

namespace PHPStudios\ForceLogin\Plugin\Guest;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Form
 */
class Form extends ForceLogin
{
    /**
     * @param Form $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Sales\Controller\Guest\Form $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::ORDER_RETURN))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
