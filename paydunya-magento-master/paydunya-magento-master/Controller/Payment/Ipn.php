<?php
/**
 * Copyright © 2019 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Controller\Payment;
 
/**
 * Ipn Payment Controller
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Ipn extends \Magento\Framework\App\Action\Action
{
    protected $dataFunctions;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Paydunya\PaydunyaMagento\Helper\Data $dataFunctions
    ) 
    {
        $this->dataFunctions = $dataFunctions;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }
    
    public function execute()
    {
        try {
            //Prenez votre MasterKey, hashez la et comparez le résultat au hash reçu par IPN
            if($_POST['data']['hash'] === hash('sha512', $this->scopeConfig->getValue('payment/paydunya/master_key'))) {

              if ($_POST['data']['status'] == "completed") {
                /** update the order's state
                 * send order email and move to the success page
                 */
                $this->dataFunctions->updateOrder($orderId, $trackingId, 'completeorder');
              }

            } else {
                die("An error occured while processing the response.");
            }
        } catch(Exception $e) {
            die('An error occured while processing the response.');
        }

		exit;
    }
}
