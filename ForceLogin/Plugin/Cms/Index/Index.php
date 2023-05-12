<?php

namespace PHPStudios\ForceLogin\Plugin\Cms\Index;

use Magento\Cms\Helper\Page;
use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class Index
 */
class Index extends ForceLogin
{
    /**
     * @param \Magento\Cms\Controller\Index\Index $subject
     * @param \Closure $proceed
     * @param null $coreRoute
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundExecute(\Magento\Cms\Controller\Index\Index $subject, \Closure $proceed, $coreRoute = null)
    {
        $pageId = $this->helperData->getCmsPageConfig(Page::XML_PATH_HOME_PAGE);
        $forceCmsPageIds = $this->helperData->getCmsPageId();
        $forceCmsPage = strpos($forceCmsPageIds, $pageId);

        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_INDEX)) || $forceCmsPage === false) {
            return $proceed();
        }

        return $this->redirectToLogin();
    }
}
