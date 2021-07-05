<?php
/**
 * Copyright © 2019 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Controller\Payment;
use Paydunya\PaydunyaMagento\Helper\Data;

 
/**
 * Response Payment Controller
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Response extends \Magento\Framework\App\Action\Action
{
    protected $resource;
    protected $dataFunctions;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\ResourceConnection $resource,
        Data $dataFunctions
    ) {
        $this->resource = $resource;
        $this->dataFunctions = $dataFunctions;

        parent::__construct($context);
    }
    
    public function execute()
    {
        $invoiceToken = $_GET['token'];
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	    $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        
        $invoice = new \Paydunya\Checkout\CheckoutInvoice();
        if($invoiceToken && $invoice->confirm($invoiceToken)) {
            $orderId = $invoice->getCustomData("order_id");
            $connection = $this->resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);
            $trackingTable = $this->resource->getTableName('sales_order');
            $query = "UPDATE " . $trackingTable . " SET `paydunya_invoice_token` = '" . $invoiceToken . "' WHERE `increment_id` = '". $orderId . "' ";
            $connection->rawQuery($query);

            /*
             * Update the order's state
             * send order email and move to the success page
             */
            $this->dataFunctions->updateOrder($orderId, $invoiceToken, 'processingorder');

            $this->_redirect('checkout/onepage/success');
        } else {
            // There is a problem in the response we got
            $this->dataFunctions->cancelAction();
            $this->_redirect('checkout/onepage/failure');
        }
    }
}
