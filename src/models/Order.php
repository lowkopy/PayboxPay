<?php

/*
 * This file is part of the Pay package in (c)Paybox Integration Component.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Paybox\Pay\Models;

use Paybox\Core\Abstractions\Order as CoreOrder;

/**
 * @see Paybox\Core\Abstractions\Order
 *
 * @package Paybox\Pay\Models
 * @version 1.2.2
 * @author Sergey Astapenko <sa@paybox.money> @link https://paybox.money
 * @copyright LLC Paybox.money
 * @license GPLv3 @link https://www.gnu.org/licenses/gpl-3.0-standalone.html
 *
 * @property-write string $id
 * @property-write int $amount
 * @property-write string $description
 *
 * @method setId(string $id):bool
 * @method setAmount(int $amount):bool
 * @method setDescription(string $description):bool
 * @method setRecurringProfile(int $recurringProfileId):bool
 * @method setCurrency(string $currency):bool
 *
 */

final class Order extends CoreOrder {

    /**
     * @var int $recurringProfile
     * @see Paybox\Pay\Models\Config::$isRecurringStart
     */
    public $recurringProfile;

    /**
     * @var string $currency
     */
    public $currency;

}
