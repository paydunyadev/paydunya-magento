<?php
/**
 * Copyright © 2019 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Block;

class PaydunyaMagento extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;
    protected $salesOrderFactory;
    protected $checkoutSession;
    protected $getCatalogSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\Order $salesOrderFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\Session $catalogSession, 
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->scopeConfig = $scopeConfig;
        $this->salesOrderFactory = $salesOrderFactory;
        $this->getCatalogSession = $catalogSession;

        $this->_isScopePrivate = true;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    /**
    * Retrieve current order
    *
    * @return \Magento\Sales\Model\Order
    */
    public function getOrder()
    {
       $orderId = $this->checkoutSession->getLastOrderId();
       $order = $this->salesOrderFactory->load($orderId);
       return $order->getData(); // you can access various order details from here. 
    }
}
