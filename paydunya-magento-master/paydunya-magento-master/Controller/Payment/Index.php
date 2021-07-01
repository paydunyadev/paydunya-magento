<?php
/**
 * Copyright © 2019 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Controller\Payment;
use Paydunya\PaydunyaMagento\Helper\Data;
 
/**
 * Index Payment Controller
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Index extends \Magento\Framework\App\Action\Action
{
    protected $salesOrderFactory;
    protected $checkoutSession;
    protected $dataFunctions;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Sales\Model\Order $salesOrderFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        Data $dataFunctions,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->salesOrderFactory = $salesOrderFactory;
        $this->checkoutSession = $checkoutSession;
        $this->dataFunctions = $dataFunctions;
 	    $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }
    
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
       
        $orderid = $this->checkoutSession->getLastRealOrder()->getIncrementId();
       
        $order = $this->salesOrderFactory->loadByIncrementId($orderid);

        $orderDetails = $order->getData();

        $orderDetails["p_store_name"] = $storeManager->getStore()->getFrontendName();
        $orderDetails["p_store_website_url"] = $storeManager->getStore()->getBaseUrl();
        $logo = $objectManager->get('\Magento\Theme\Block\Html\Header\Logo');
        $orderDetails["p_store_logo_url"] = $logo->getLogoSrc();
        $orderDetails["p_cancel_url"] = $storeManager->getStore()->getBaseUrl() . "paydunyamagento/payment/response";
        $orderDetails["p_return_url"] = $storeManager->getStore()->getBaseUrl() . "paydunyamagento/payment/response";
        $orderDetails["p_callback_url"] = $storeManager->getStore()->getBaseUrl() . "paydunyamagento/payment/ipn";
        $orderDetails['p_order_items'] = $orderItems = $order->getAllItems();
        $orderDetails["p_desc"] = "Payments for order no." . $orderDetails['increment_id'] . " Amounting to ".$orderDetails['order_currency_code'] . " " .$orderDetails['grand_total'] . " bought from ".$storeManager->getStore()->getName();
    
        $redirect = $this->scopeConfig->getValue('payment/paydunya/redirect');

        $iframe = $this->dataFunctions->paydunyaIframe($orderDetails, $redirect);
    
        if($redirect) {
            $this->_redirect($iframe);
        } else {
            $this->_view->loadLayout();
            
            $this->_view->getLayout()->initMessages(); //var_dump($this->_view->getLayout()->getBlock('paydunyamagento')); die();
           
            $this->_view->getLayout()->getBlock('paydunyamagento')->setData("iframe", $iframe);
            
            $this->_view->getLayout()->getBlock('paydunyamagento')->setName("PayDunya Payment");
            
            $this->_view->renderLayout();
        }
    }
}
