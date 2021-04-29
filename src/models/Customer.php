<?php

/*
 * This file is part of the Pay package in (c)Paybox Integration Component.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Paybox\Pay\Models;

use Paybox\Core\Abstractions\Customer as CoreCustomer;

/**
 * @see Paybox\Core\Abstractions\Customer
 *
 * @package Paybox\Pay\Models
 * @version 1.2.2
 * @author Sergey Astapenko <sa@paybox.money> @link https://paybox.money
 * @copyright LLC Paybox.money
 * @license GPLv3 @link https://www.gnu.org/licenses/gpl-3.0-standalone.html
 *
 * @property-write string $id
 * @property-write string $userEmail
 *
 * @method setId(string $id):bool
 * @method setUserEmail(string $email):bool
 * @method setUserPhone(int $phone):bool
 * @method setIp(string $ip):bool
 *
 */

final class Customer extends CoreCustomer {

    /**
     * @var int $userPhone Required. contact phone of customer
     */
    public $userPhone;

    /**
     * @var string $ip Required. IP-address of customer
     */
    public $ip;

}
