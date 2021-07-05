<?php
/**
 * Copyright © 2019 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Model;
 
/**
 * Pay In Store payment method model
 */
class Paydunya extends \Magento\Payment\Model\Method\AbstractMethod
{
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'paydunya';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;
    
    protected $_isInitializeNeeded = true;
   
    protected $_canUseInternal = true;
}
