<?php

namespace PHPStudios\ForceLogin\Controller\Account;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Login
 */
class Login extends \Magento\Customer\Controller\Account\Login
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var \Magento\Customer\Model\Session $customerSession
     */
    protected $customerSession;

    /**
     * @var \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CatalogSession
     */
    protected $catalogSession;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Login constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     * @param CatalogSession $catalogSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        CatalogSession $catalogSession,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct(
            $context,
            $customerSession,
            $resultPageFactory
        );
        $this->catalogSession = $catalogSession;
        $this->storeManager = $storeManager;
    }

    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\Result\Redirect|\Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $previousUrl = $this->_redirect->getRefererUrl();
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        $controllerName = str_replace($baseUrl, "", $previousUrl);
        if ($controllerName == "customer/account/createpassword/") {
            $previousUrl = $baseUrl . 'customer/account/index';
            $this->catalogSession->setPreviousUrl($previousUrl);
        } else {
            $this->catalogSession->setPreviousUrl($previousUrl);
        }
        return parent::execute();
    }
}
