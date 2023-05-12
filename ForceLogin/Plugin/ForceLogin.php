<?php

namespace PHPStudios\ForceLogin\Plugin;

use Magento\Customer\Model\SessionFactory as CustomerSessionFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use PHPStudios\ForceLogin\Helper\Data;

/**
 * Class ForceLogin
 */
class ForceLogin
{
    const SEARCH_TERM = 'search_term';
    const ADVANCE_SEARCH = 'advance_search';
    const SEARCH_RESULT = 'search_result';
    const CART = 'cart';
    const CATEGORY = 'category';
    const CMS_INDEX = 'cms_index';
    const CMS_NO_ROUTE = 'cms_noroute';
    const CMS_PAGE = 'cms_page';
    const CONTACT = 'contact';
    const ORDER_RETURN = 'order_return';
    const CHECKOUT_INDEX = 'checkout_index';
    const PRODUCT = 'product';

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var CustomerSessionFactory
     */
    protected $customerSessionFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * ForceLogin constructor.
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $resultRedirectFactory
     * @param CustomerSessionFactory $customerSessionFactory
     * @param Data $helperData
     */
    public function __construct(
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory,
        CustomerSessionFactory $customerSessionFactory,
        Data $helperData
    ) {
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->customerSessionFactory = $customerSessionFactory;
        $this->helperData = $helperData;
    }

    /**
     * @param $case
     * @return bool
     */
    protected function forceLoginEnable($case)
    {
        $config = false;
        switch ($case) {
            case self::ADVANCE_SEARCH:
                $config = $this->helperData->isEnableAdvancedSearchPage();
                break;
            case self::SEARCH_RESULT:
                $config = $this->helperData->isEnableSearchResultPage();
                break;
            case self::CART:
                $config = $this->helperData->isEnableCartPage();
                break;
            case self::CATEGORY:
                $config = $this->helperData->isEnableCategoryPage();
                break;
            case self::CMS_INDEX:
                $config = $this->helperData->isEnableCmsPage();
                break;
            case self::CMS_NO_ROUTE:
                $config = $this->helperData->isEnableCmsPage();
                break;
            case self::CMS_PAGE:
                $config = $this->helperData->isEnableCmsPage();
                break;
            case self::CONTACT:
                $config = $this->helperData->isEnableContactPage();
                break;
            case self::ORDER_RETURN:
                $config = $this->helperData->isEnableGuestForm();
                break;
            case self::CHECKOUT_INDEX:
                $config = $this->helperData->isEnableCheckoutPage();
                break;
            case self::PRODUCT:
                $config = $this->helperData->isEnableProductPage();
                break;
            case self::SEARCH_TERM:
                $config = $this->helperData->isEnableSearchTermPage();
                break;
            default:
                break;
        }
        return ($this->helperData->isEnable() && $config);
    }

    /**
     * @return bool
     */
    protected function isLoggedIn()
    {
        return $this->customerSessionFactory->create()->isLoggedIn();
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function redirectToLogin()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $message = $this->helperData->getAlertMessage();
        if ($message) {
            $this->messageManager->addErrorMessage(__($message));
        }
        return $resultRedirect->setPath('customer/account/login');
    }
}
