# API для приёма платежей PayBox.Money
___
Пакет упрощает интеграцию взаимодействия с приёмами платежей Paybox.

## 1) Установка пакета

Для установки пакета пропишите команду в консольке:

```sh
$ composer require payboxmoney/pay "^1.2"
```


## 2) Запросы
  - [Инициализация Напрямую через PayBox](#Инициализация-Напрямую-через-PayBox)
  - [Запрос на клиринг транзакций по банковским картам](#Запрос-на-клиринг-транзакций-по-банковским-картам)
  - [Запрос на получение статуса платежа](#Запрос-на-получение-статуса-платежа)
  - [Запрос на получение списка платежных систем](#Запрос-на-получение-списка-платежных-систем)
  - [Отмена платежа до оплаты](#Отмена-платежа-до-оплаты)
  - [Отмена платежа после оплаты](#Отмена-платежа-после-оплаты)
  - [Создание рекуррентного платежа](#Создание-рекуррентного-платежа)
  - [Повторение рекуррентного платежа](#Повторение-рекуррентного-платежа)

### Инициализация Напрямую через PayBox

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Inicializaciya-Napryamuyu-cherez-PayBox)

#### Пример #1
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();

$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
$paybox->order->description = 'test order';
$paybox->order->amount = 100;

if($paybox->init()) {
    header('Location:' . $paybox->redirectUrl);
}
~~~

#### Пример #2
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();

$paybox->getMerchant()->setId(123456);
$paybox->getMerchant()->setSecretKey('asflerjgsdfv');
$paybox->getOrder()->setAmount(100);
$paybox->getOrder()->setDescription('test order');

if($paybox->init()) {
    header('Location:' . $paybox->redirectUrl);
}
~~~

#### Пример #3
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();

$merchant = $paybox->getMerchant();
$merchant->setId(123456);
$merchant->setSecretKey('asflerjgsdfv');

$order = $paybox->getOrder();
$order->setAmount(100);
$order->setDescription('test order');

if($paybox->init()) {
    header('Location:' . $paybox->redirectUrl);
}
~~~

### Запрос на клиринг транзакций по банковским картам

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Vspomogatelnye-zaprosy/paths/~1do_capture.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
//If You have a ID of payment and it status is success
//You can initialize the clearing operation using capture() method
$paybox->payment->id = 12345;
$result = $paybox->capture();
~~~


### Запрос на получение статуса платежа

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Vspomogatelnye-zaprosy/paths/~1get_status.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
//set required properties
$paybox->getMerchant()
    ->setId(123456)
    ->setSecretKey('asflerjgsdfv');
    
// Не обязательно
$paybox->getPayment()
    ->setId(11044111);
    
$paybox->order->id = 2;
$paymentStatus = $paybox->getStatus(); //partial/pending/ok/failed/revoked/incomplete
~~~

### Запрос на получение списка платежных систем

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Vspomogatelnye-zaprosy/paths/~1ps_list.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
//set required properties
$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
$paybox->order->amount = 100;
$paymentSystems = $paybox->getPaymentSystems();
~~~

### Отмена платежа до оплаты

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Vspomogatelnye-zaprosy/paths/~1cancel.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
$request = (array_key_exists('pg_xml', $_REQUEST))
    ? $paybox->parseXML($_REQUEST)
    : $_REQUEST;
$result = $paybox->cancelBill();
~~~

### Отмена платежа после оплаты

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Vspomogatelnye-zaprosy/paths/~1revoke.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
//set required properties
$paybox->getMerchant()
    ->setId(123456)
    ->setSecretKey('asflerjgsdfv');
$paybox->getPayment()
    ->setId(11044111);
//if you need to revoke a part of payment, You must use the "revoke" method with a argument
$result = $paybox->revoke(100);
//OR
//if no artuments, whole the payment was be revoked
$result = $paybox->revoke();
~~~

### Создание рекуррентного платежа

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Rekurrentnyj-platezh)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
$paybox->order->description = 'test order';
$paybox->order->amount = 100;
$recurrentProfileLifetime = 12 //min = 1 month, max 156 monthes
if($paybox->recurringStart($recurrentProfileLifetime)) {
    header('Location:' . $paybox->redirectUrl);
}
~~~

### Повторение рекуррентного платежа

[Подробное описание](https://paybox.money/docs/ru/pay-in/3.3#tag/Rekurrentnyj-platezh/paths/~1make_recurring_payment.php/post)

#### Пример:
~~~php
<?php
use Paybox\Pay\Facade as Paybox;
$paybox = new Paybox();
$paybox->merchant->id = 123456;
$paybox->merchant->secretKey = 'asflerjgsdfv';
$paybox->order->description = 'test order';
$paybox->order->recurringProfile = 1234;
$result = $paybox->makePayment();
~~~
