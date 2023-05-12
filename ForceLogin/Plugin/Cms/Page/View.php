<?php

namespace PHPStudios\ForceLogin\Plugin\Cms\Page;

use Magento\Customer\Model\SessionFactory as CustomerSessionFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use PHPStudios\ForceLogin\Helper\Data;
use Magento\Cms\Helper\Page;
use Magento\Store\Model\StoreManagerInterface;
use PHPStudios\ForceLogin\Plugin\ForceLogin;

/**
 * Class View
 */
class View extends ForceLogin
{
    /**
     * @var Page
     */
    protected $pageCms;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * View constructor.
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $resultRedirectFactory
     * @param CustomerSessionFactory $customerSessionFactory
     * @param Data $helperData
     * @param Page $pageCms
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory,
        CustomerSessionFactory $customerSessionFactory,
        Data $helperData,
        Page $pageCms,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct(
            $messageManager,
            $resultRedirectFactory,
            $customerSessionFactory,
            $helperData
        );
        $this->pageCms = $pageCms;
        $this->storeManager = $storeManager;
    }

    /**
     * AroundExecute
     * @param \Magento\Cms\Controller\Page\View $subject
     * @param \Closure $proceed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function aroundExecute(\Magento\Cms\Controller\Page\View $subject, \Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_PAGE))) {
            return $proceed();
        }
        $forceCmsPageId = $this->helperData->getCmsPageId();
        $pageId = $subject->getRequest()->getParam(
            'page_id',
            $subject->getRequest()->getParam('id', false)
        );

        $cmsUrl = str_replace(
            $this->storeManager->getStore()->getBaseUrl(),
            '',
            $this->pageCms->getPageUrl($pageId)
        );
        if (strpos($forceCmsPageId, $cmsUrl) !== false) {
            return $this->redirectToLogin();
        }
        return $proceed();
    }
}
