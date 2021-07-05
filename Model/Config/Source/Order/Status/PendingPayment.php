<?php
/**
 * Copyright © 2019. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Paydunya\PaydunyaMagento\Model\Config\Source\Order\Status;

use Magento\Sales\Model\Order;
use Magento\Sales\Model\Config\Source\Order\Status;

/**
 * Order Status source model
 */
class PendingPayment extends Status
{
    /**
     * @var string[]
     */
    protected $_stateStatuses = [Order::STATE_PENDING_PAYMENT];
}
