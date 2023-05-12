<?php

namespace PHPStudios\ForceLogin\Plugin\Contact;

use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\Contact\Controller\Index\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Contact\Controller\Index\Index $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CONTACT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}
