<?php
namespace Paydunya\PaydunyaMagento\Helper;

use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Store\Model\Store;
use Paydunya\PaydunyaMagento\Helper\PaydunyaCheckStatus;
use \Magento\Sales\Model\ResourceModel\Order;
 
/**
 * Checkout default helper
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $checkoutSession;
    protected $salesOrderFactory;
    protected $scopeConfig;
    protected $statuses;
    protected $paydunya;
    protected $invoiceSender;
    protected $order;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
         \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order $salesOrderFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Sales\Model\Config\Source\Order\Status $statuses,
        \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $invoiceSender,
        PaydunyaCheckStatus $paydunya,
        Order $order
     ) {
        $this->checkoutSession = $checkoutSession;
        $this->salesOrderFactory = $salesOrderFactory;
        $this->scopeConfig = $scopeConfig;
        $this->statuses = $statuses;
        $this->paydunya = $paydunya;
        $this->invoiceSender = $invoiceSender;
        $this->order = $order;

        parent::__construct($context);
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function updateOrder($orderId, $paydunyaInvoiceToken, $action)
    {
        $order = $this->salesOrderFactory->loadByIncrementId($orderId);
        $results = $this->detailedCheckStatus($paydunyaInvoiceToken);
        
        //Get order status
        $status	= $results['status'];

        /** Update the order status if is new order
         * or
         * if action is cron, the new status is not pending
         */
        if($action == 'neworder' || $status != 'pending'){
            if($status == 'completed'){
                if($order->getStatus() !== "complete") {
                    $order->setState(\Magento\Sales\Model\Order::STATE_COMPLETE);
                  
                    $order->setStatus('complete');   
               
                    // Create invoice for this order
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

                    $invoice = $objectManager->create('Magento\Sales\Model\Service\InvoiceService')->prepareInvoice($order);
                
                    $invoice->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_OFFLINE);
               
                    $invoice->register();
               
                    // Save the invoice to the order
                    $transaction = $objectManager->create('Magento\Framework\DB\Transaction')
                        ->addObject($invoice)
                        ->addObject($invoice->getOrder());
            
                    $transaction->save();
            
                    $this->invoiceSender->send($invoice);
                
                    $order->addStatusHistoryComment(
                        __('Notified customer about invoice #%1.', $invoice->getId())
                    )->setIsCustomerNotified(true);
                }
            } else if($status == 'pending') {
                $order->setState(\Magento\Sales\Model\Order::STATE_PROCESSING);
            } else if($status == 'failed') {
                $order->setState(\Magento\Sales\Model\Order::STATE_CANCELED);
            } else if($status == 'invalid') {
                $order->setState(\Magento\Sales\Model\Order::STATE_CANCELED);
            } else {
                $order->setState(\Magento\Sales\Model\Order::STATE_CANCELED);
            }
        }

        /** Send mail if is a new order
         * or
         * If action is cron, send mail only if status changes to COMPLETED or FAILED
         */
        if($action == 'neworder' || $status == 'completed' || $status == 'failed'){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $objectManager->create('Magento\Sales\Model\OrderNotifier')->notify($order);
        }
 
        $this->order->save($order);

        return $status;
    }

     
   public function detailedCheckStatus($paydunyaInvoiceToken)
   {
        return $this->paydunya->detailedcheckStatus($paydunyaInvoiceToken);
    }

    public function paydunyaIframe($order, $redirect=false) {
        return $this->paydunya->loadIframe($order, $redirect);
    }
    
    public function cancelAction() {
        if ($this->checkoutSession->getLastOrderId()) {
            $order = $this->salesOrderFactory->load($this->checkoutSession->getLastOrderId());
            if($order->getId()) {
                // Flag the order as 'cancelled' and save it
                $order->cancel()->setState(\Magento\Sales\Model\Order::STATE_CANCELED, true, 'PayDunya Gateway has declined the payment.')->save();
            }
        }
    }
}