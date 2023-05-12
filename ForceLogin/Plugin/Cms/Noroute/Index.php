<?php

namespace PHPStudios\ForceLogin\Plugin\Cms\Noroute;

use Magento\Cms\Helper\Page;
use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\Cms\Controller\Noroute\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Cms\Controller\Noroute\Index $subject, \Closure $proceed)
    {
        $pageId = $this->helperData->getCmsPageConfig(Page::XML_PATH_NO_ROUTE_PAGE);
        $forceCmsPageId = $this->helperData->getCmsPageId();
        $forceCmsPage = strpos($forceCmsPageId, $pageId);

        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_NO_ROUTE)) || $forceCmsPage === false) {
            return $proceed();
        }

        return $this->redirectToLogin();
    }
}
