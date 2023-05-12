<?php

namespace PHPStudios\ForceLogin\Plugin;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use PHPStudios\ForceLogin\Helper\Data;

/**
 * Class OtherPage
 */
class OtherPage
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var Http
     */
    protected $requested;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var Session
     */
    protected $authSession;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     * OtherPage constructor.
     * @param Context $context
     * @param Data $helperData
     * @param Session $authSession
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Http $requested
     */
    public function __construct(
        Context $context,
        Data $helperData,
        Session $authSession,
        \Magento\Framework\App\Http\Context $httpContext,
        Http $requested
    ) {
        $this->helperData = $helperData;
        $this->url = $context->getUrl();
        $this->messageManager = $context->getMessageManager();
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->authSession = $authSession;
        $this->httpContext = $httpContext;
        $this->requested = $requested;
    }

    /**
     * @param \Magento\Framework\App\Action\Action $subject
     * @param callable $proceed
     * @param RequestInterface $request
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function aroundDispatch(
        \Magento\Framework\App\Action\Action $subject,
        callable $proceed,
        RequestInterface $request
    ) {
        $customPath = $this->requested->getModuleName() . "_" .
            $this->requested->getControllerName() . "_" .
            $this->requested->getActionName();

        $arrayOfUrls = explode(',', $this->helperData->getDirectUrl());
        $urls = str_replace('/', '_', $arrayOfUrls);

        foreach ($urls as $link) {
            if ($customPath == $link) {
                return $proceed($request);
            }
        }

        $result = $proceed($request);
        $resultPage = $result instanceof \Magento\Framework\View\Result\Page;

        $adminSession = $this->authSession->isLoggedIn();
        $customerLogin = $this->httpContext->getValue(
            \Magento\Customer\Model\Context::CONTEXT_AUTH
        );

        if (
            $this->helperData->isEnableRegister() &&
            strpos($request->getFullActionName(), 'customer_account_create') !== false
        ) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $message = $this->helperData->getAlertMessage();
            if ($message) {
                $this->messageManager->addErrorMessage($message);
            }
            return $resultRedirect->setPath('customer/account/login');
        } elseif (in_array($request->getFullActionName(), $this->getIgnoreList()) || !$resultPage) {
            return $result;
        } elseif ($adminSession) {
            return $result;
        } elseif (
            $this->helperData->isEnable() &&
            $this->helperData->isEnableOtherPage() &&
            !$customerLogin
        ) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $message = $this->helperData->getAlertMessage();
            if ($message) {
                $this->messageManager->addErrorMessage($message);
            }
            return $resultRedirect->setPath('customer/account/login');
        } else {
            return $result;
        }
    }

    /**
     * Get IgnoreList
     * @return array
     */
    public function getIgnoreList()
    {
        $list = ['catalog_product_view', 'catalog_category_view', 'checkout_cart_index',
            'checkout_index_index', 'search_term_popular', 'catalogsearch_result_index',
            'catalogsearch_advanced_index', 'cms_page_view', 'cms_noroute_index',
            'cms_index_index', 'customer_account_login', 'customer_account_loginPost',
            'customer_account_logoutSuccess', 'customer_account_logout', 'customer_account_resetPassword',
            'customer_account_resetPasswordpost', 'customer_account_index', 'customer_account_forgotpassword',
            'customer_account_forgotpasswordpost', 'customer_account_createPassword', 'customer_account_createpassword',
            'customer_account_createPost', 'adminhtml_index_index', 'adminhtml_noroute_index', 'adminhtml_auth_login',
            'adminhtml_dashboard_index', 'adminhtml_auth_logout', 'contact_index_index', 'b2b_account_create',
            'customer_account_create'
        ];

        return $list;
    }
}
