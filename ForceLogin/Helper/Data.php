<?php

namespace PHPStudios\ForceLogin\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Model\SessionFactory as CatalogSessionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 */
class Data extends AbstractHelper
{
    /**
     * CookieMetadataFactory
     * @var CookieMetadataFactory $cookieMetadataFactory
     */
    protected $cookieMetadataFactory;

    /**
     * PhpCookieManager
     * @var PhpCookieManager $cookieMetadataManager
     */
    protected $cookieMetadataManager;

    /**
     * @var CatalogSessionFactory
     */
    protected $catalogSessionFactory;

    /**
     * Data constructor.
     * @param CatalogSessionFactory $catalogSessionFactory
     * @param CookieMetadataFactory $cookieMetadataFactory
     * @param PhpCookieManager $cookieMetadataManager
     * @param Context $context
     */
    public function __construct(
        CatalogSessionFactory $catalogSessionFactory,
        CookieMetadataFactory $cookieMetadataFactory,
        PhpCookieManager $cookieMetadataManager,
        Context $context
    ) {
        parent::__construct($context);
        $this->catalogSessionFactory = $catalogSessionFactory;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->cookieMetadataManager = $cookieMetadataManager;
    }

    /**
     * To Enable Force Login on All Pages
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/general/enable',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for product page
     * @return bool
     */
    public function isEnableProductPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/product_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for category page
     * @return bool
     */
    public function isEnableCategoryPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/category_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for cart page
     * @return bool
     */
    public function isEnableCartPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/cart_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for checkout page
     * @return bool
     */
    public function isEnableCheckoutPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/checkout_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for contact page
     * @return bool
     */
    public function isEnableContactPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/contact_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for Guest Form Page
     * @return bool
     */
    public function isEnableGuestForm()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/order_return',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for search term page
     * @return bool
     */
    public function isEnableSearchTermPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/search_term_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for search result page
     * @return bool
     */
    public function isEnableSearchResultPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/search_results_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable force login for advanced search page
     * @return bool
     */
    public function isEnableAdvancedSearchPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/advanced_search_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isEnableOtherPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/other_page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Enable customer register
     * @return bool
     */
    public function isEnableRegister()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/general/disable_register',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get alert message after redirect login page
     * @return string
     */
    public function getAlertMessage()
    {
        return $this->scopeConfig->getValue(
            'forcelogin/page/message',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get redirect url after login
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->scopeConfig->getValue(
            'forcelogin/redirect/page',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get customer url after login
     * @return string
     */
    public function getCustomUrl()
    {
        $pageRedirect = $this->scopeConfig->getValue(
            'forcelogin/redirect/custom_url',
            ScopeInterface::SCOPE_STORE
        );

        $this->scopeConfig->getValue(
            'system_config_path',
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
        );

        return $pageRedirect;
    }

    /**
     * Enable force login for cms page
     * @return bool
     */
    public function isEnableCmsPage()
    {
        return $this->scopeConfig->isSetFlag(
            'forcelogin/page/enable',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get cms Page id
     * @return string
     */
    public function getCmsPageId()
    {
        $cmsPageId = $this->scopeConfig->getValue(
            'forcelogin/page/page_id',
            ScopeInterface::SCOPE_STORE
        );
        return $cmsPageId;
    }

    /**
     * Get Redirect config default
     * @return bool
     */
    public function isRedirectDashBoard()
    {
        return $this->scopeConfig->isSetFlag(
            'customer/startup/redirect_dashboard',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return \Magento\Catalog\Model\Session
     */
    public function getSessionCatalog()
    {
        return $this->catalogSessionFactory->create();
    }

    /**
     * Get Cms Index Page Id
     * @param string $pathPage
     * @return mixed
     */
    public function  getCmsPageConfig($pathPage)
    {
        return $this->scopeConfig->getValue(
            $pathPage,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve cookie manager
     *
     * @return PhpCookieManager
     * @deprecated
     */
    public function getCookieManager()
    {
        if (!$this->cookieMetadataManager) {
            $this->cookieMetadataManager = ObjectManager::getInstance()->get(
                PhpCookieManager::class
            );
        }
        return $this->cookieMetadataManager;
    }

    /**
     * @return CookieMetadataFactory|mixed
     */
    public function getCookieMetadataFactory()
    {
        if (!$this->cookieMetadataFactory) {
            $this->cookieMetadataFactory = ObjectManager::getInstance()->get(
                CookieMetadataFactory::class
            );
        }
        return $this->cookieMetadataFactory;
    }

    /**
     * @return mixed
     */
    public function getDirectUrl()
    {
        return $this->scopeConfig->getValue(
            'forcelogin/page/direct_access',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
