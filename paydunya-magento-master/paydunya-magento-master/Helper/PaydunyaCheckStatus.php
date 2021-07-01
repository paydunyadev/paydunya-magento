<?php
 
namespace Paydunya\PaydunyaMagento\Helper;

class PaydunyaCheckStatus extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $sandbox;
	protected $masterKey;
	protected $privateKey;
	protected $token;
	protected $mode;

	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
 		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
 	) {
		parent::__construct($context);

		$this->sandbox = $this->scopeConfig->getValue('payment/paydunya/sandbox');
        $this->masterKey = $this->scopeConfig->getValue('payment/paydunya/master_key');
        $this->privateKey = $this->sandbox 
        	? $this->scopeConfig->getValue('payment/paydunya/test_private_key')
        	: $this->scopeConfig->getValue('payment/paydunya/live_private_key');
        $this->token = $this->sandbox 
        	? $this->scopeConfig->getValue('payment/paydunya/test_token')
        	: $this->scopeConfig->getValue('payment/paydunya/live_token');
        $this->mode = $this->sandbox ? 'test': 'live';

		\Paydunya\Setup::setMasterKey($this->masterKey);
		\Paydunya\Setup::setPrivateKey($this->privateKey);
		\Paydunya\Setup::setToken($this->token);
		\Paydunya\Setup::setMode($this->mode);
	}
		
	public function detailedcheckStatus($paydunyaInvoiceToken){
 		$invoice = new \Paydunya\Checkout\CheckoutInvoice();
 		if ($invoice->confirm($paydunyaInvoiceToken)) {
 			return ['status' => $invoice->getStatus()];
 		} else {
 			return ['status' => 'invalid'];
 		}
	}

	public function loadIframe($orderDetails=array(), $redirect=false)
	{
		\Paydunya\Checkout\Store::setName($orderDetails['p_store_name']);
		\Paydunya\Checkout\Store::setWebsiteUrl($orderDetails['p_store_website_url']);
		\Paydunya\Checkout\Store::setLogoUrl($orderDetails['p_store_logo_url']);

		if(count($orderDetails)){
			$invoice = new \Paydunya\Checkout\CheckoutInvoice();
			$invoice->setCallbackUrl($orderDetails['p_callback_url']);
			$invoice->setCancelUrl($orderDetails['p_cancel_url']);
			$invoice->setReturnUrl($orderDetails['p_return_url']);
			$items = $orderDetails['p_order_items'];
			foreach ($items as $item) {
				$invoice->addItem($item->getName(), $item->getQtyOrdered(), $item->getPrice(), $item->getRowTotal(), $item->getDescription());
			}
			$invoice->setDescription($orderDetails["p_desc"]);
			$invoice->setTotalAmount($orderDetails['grand_total']);
			$invoice->addCustomData('order_id', $orderDetails['increment_id']);

			if($invoice->create()) {
				$iframe_src = $invoice->getInvoiceUrl();
			} else {
				die($invoice->response_text);
			}
			
			$iframe = '<iframe src="'. $iframe_src.'" width="100%" height="700px" scrolling="no" frameBorder="0"><p>Browser unable to load iFrame</p></iframe>';
			
			if(! $redirect) {
				return $iframe;
			} else {
				return $iframe_src;
			}
		}
	}
}
