<?php


namespace App\Helpers;


class Constant
{
    const NOTIFICATION_TYPE = [
        'General'=>1,
        'Ticket'=>2,
        'Subscription'=>3,
        'Order'=>4,
    ];
    const VERIFICATION_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const VERIFICATION_TYPE_RULES = '1,2';
    const TICKETS_STATUS = [
        'Open'=>1,
        'Closed'=>2
    ];
    const SENDER_TYPE = [
        'User'=>1,
        'Admin'=>2,
    ];
    const SUBSCRIPTION_TYPES = [
        'Monthly'=>1,
        'Quarterly'=>3,
        'SemiAnnually'=>6,
        'Annually'=>12,
    ];
    const SUBSCRIPTION_STATUSES = [
        'Pending'=>0,
        'Approved'=>1,
        'Rejected'=>2,
        'Canceled'=>3,
    ];
    const PAYMENT_METHOD = [
        'BankTransfer'=>1,
        'Cash'=>2,
    ];
    const PAYMENT_METHOD_RULES = '1,2';

    const TRANSACTION_STATUS = [
        'Pending'=>1,
        'Paid'=>2,
    ];
    const TRANSACTION_TYPES = [
        'Deposit'=>1,
        'Withdraw'=>2,
        'Holding'=>3,
    ];
    const MEDIA_TYPES = [
        'Food'=>1
    ];
    const SETTING_TYPE = [
        'Page'=>1,
        'Notification'=>2,
        'Values'=>3,
    ];
    const USER_TYPE=[
        'Customer'=>1,
        'Provider'=>2
    ];
    const USER_TYPE_RULES = '1,2';
    const PROVIDER_TYPE=[
        'CoffeeShop'=>1,
        'Restaurant'=>2
    ];
    const PROVIDER_TYPE_RULES = '1,2';
    const ORDER_STATUSES=[
        'PendingApproval'=>1,
        'Approved'=>2,
        'Rejected'=>3,
        'Canceled'=>4,
        'Finished'=>5,
        'NotReceived'=>6,
        'NotDelivered'=>7,
    ];
    const ORDER_STATUSES_RULES = '1,2,3,4,5,6,7';
    const REVIEW_TYPE=[
        'Order'=>1,
        'Food'=>2,
        'Provider'=>3
    ];
    const REVIEW_TYPE_RULES = '1,2,3';
    const ADVERTISEMENT_TYPE=[
        'Inside'=>1,
        'Outside'=>2,
    ];
    const ADVERTISEMENT_TYPE_RULES = '1,2';
    const FAVOURITE_TYPE=[
        'Provider'=>1,
        'Food'=>2,
    ];
    const FAVOURITE_TYPE_RULES = '1,2';
}
