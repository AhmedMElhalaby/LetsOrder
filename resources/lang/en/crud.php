<?php

use App\Helpers\Constant;

return [

    'Admin'=>[
        'crud_names' => 'Admins',
        'crud_name' => 'Admin',
        'crud_the_name' => 'The Admin',
        'name' => 'Name',
        'email' => 'E-Mail',
        'is_active' => 'Status',
        'avatar' => 'Avatar',
    ],
    'User'=>[
        'crud_names' => 'Users',
        'crud_name' => 'User',
        'crud_the_name' => 'The User',
        'name' => 'Name',
        'email' => 'E-Mail',
        'mobile' => 'Mobile',
        'avatar' => 'Avatar',
        'type' => 'Type',
        'bio' => 'Bio',
        'balance' => 'Balance',
        'favorite_car' => 'Favorite Car',
        'app_locale' => 'App Locale',
        'is_active' => 'Status',
        'created_at' => 'Created At',
        'Links'=>[
            'active_mobile_email'=>'Active Mobile And Email'
        ]
    ],
    'Setting'=>[
        'crud_names' => 'Settings',
        'crud_name' => 'Setting',
        'crud_the_name' => 'The Setting',
        'key' => 'Key',
        'name' => 'Name',
        'name_ar' => 'Name Ar',
        'value' => 'Value',
        'value_ar' => 'Value Ar',
        'pages'=>'Pages',
        'notifications'=>'Notifications',
        'other'=>'Other Settings'
    ],
    'Faq'=>[
        'crud_names' => 'FAQ',
        'crud_name' => 'Faq',
        'crud_the_name' => 'The Faq',
        'question' => 'Question',
        'question_ar' => 'Question Ar',
        'faq_category_id' => 'Faq Category',
        'answer' => 'Answer',
        'answer_ar' => 'Answer Ar',
        'is_active' => 'Status',
    ],
    'Ticket'=>[
        'crud_names' => 'Tickets',
        'crud_name' => 'Ticket',
        'crud_the_name' => 'The Ticket',
        'id' => '#',
        'user_id' => 'User',
        'title' => 'Title',
        'message' => 'Message',
        'ticket_response' => 'Response',
        'status' => 'Status',
        'response_form' => 'Response to the ticket',
        'Statuses'=>[
            ''.\App\Helpers\Constant::TICKETS_STATUS['Open']=>'Opened',
            ''.\App\Helpers\Constant::TICKETS_STATUS['Closed']=>'Closed',
        ]
    ],
    'Permission'=>[
        'crud_names' => 'Permissions',
        'crud_name' => 'Permission',
        'crud_the_name' => 'The Permission',
        'id' => '#',
        'name' => 'Name',
    ],
    'Role'=>[
        'crud_names' => 'Roles',
        'crud_name' => 'Role',
        'crud_the_name' => 'The Role',
        'id' => '#',
        'name' => 'Name',
        'permissions' => 'Permissions',
    ],
    'Subscription'=>[
        'crud_names' => 'Subscriptions',
        'crud_name' => 'Subscription',
        'crud_the_name' => 'The Subscription',
        'name' => 'Name',
        'description' => 'Description',
        'name_ar' => 'Name Ar',
        'description_ar' => 'Description Ar',
        'gained_balance' => 'Gained Balance',
        'price' => 'Price',
        'type' => 'Type',
        'is_active' => 'Status',
        'Types'=>[
            ''.Constant::SUBSCRIPTION_TYPES['Monthly']=>'Monthly',
            ''.Constant::SUBSCRIPTION_TYPES['Quarterly']=>'Quarterly',
            ''.Constant::SUBSCRIPTION_TYPES['SemiAnnually']=>'Semi Annually',
            ''.Constant::SUBSCRIPTION_TYPES['Annually']=>'Annually',
        ],
    ],
    'UserSubscription'=>[
        'crud_names' => 'Subscriptions',
        'crud_name' => 'Subscription',
        'crud_the_name' => 'The Subscription',
        'user_id' => 'User',
        'subscription_id' => 'Subscription',
        'payment_method' => 'Payment Method',
        'payment_detail' => 'Payment Detail',
        'status' => 'Status',
        'Statuses'=>[
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Pending']=>'Pending',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Approved']=>'Approved',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Rejected']=>'Rejected',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Canceled']=>'Canceled',
        ],

        'PaymentMethod'=>[
            \App\Helpers\Constant::PAYMENT_METHOD['Tap']=>'Tap',
        ],
        'Links'=>[
            'approve'=>'Approve',
            'reject'=>'Reject',
            'cancel'=>'Cancel',
        ]
    ],
    'Transaction'=>[
        'crud_names' => 'Transactions',
        'crud_name' => 'Transaction',
        'crud_the_name' => 'The Transaction',
        'user_id' => 'User',
        'value' => 'Value',
        'type' => 'Type',
        'Types' => [
            '1'=>'Deposit',
            '2'=>'Withdraw',
            '3'=>'Hold',
        ],
        'payment_token' => 'Payment Token',
        'ref_id' => 'References Operation',
        'created_at' => 'Date',
        'status' => 'Status',
    ],
    'Category'=>[
        'crud_names' => 'Categories',
        'crud_name' => 'Category',
        'crud_the_name' => 'The Category',
        'name' => 'Name',
        'name_ar' => 'Name Ar',
        'image' => 'Image',
        'is_active' => 'Status',
    ],
    'City'=>[
        'crud_names' => 'Cities',
        'crud_name' => 'City',
        'crud_the_name' => 'The City',
        'name' => 'Name',
        'name_ar' => 'Name Ar',
        'is_active' => 'Status',
    ],
    'Advertisement'=>[
        'crud_names' => 'Advertisements',
        'crud_name' => 'Advertisement',
        'crud_the_name' => 'The Advertisement',
        'provider_id' => 'Provider',
        'image' => 'Image',
        'url' => 'Url',
        'type' => 'Type',
        'is_active' => 'Status',
        'Types'=>[
            ''.Constant::ADVERTISEMENT_TYPE['Inside']=>'Inside App',
            ''.Constant::ADVERTISEMENT_TYPE['Outside']=>'Outside App',
        ]
    ],
    'Order'=>[
        'crud_names' => 'Orders',
        'crud_name' => 'Order',
        'crud_the_name' => 'The Order',
        'user_id' => 'User',
        'provider_id' => 'Provider',
        'order_date' => 'Order Date',
        'status' => 'Status',
        'Statuses'=>[
            ''.Constant::ORDER_STATUSES['PendingApproval']=>'Pending Approval',
            ''.Constant::ORDER_STATUSES['Approved']=>'Approved',
            ''.Constant::ORDER_STATUSES['Rejected']=>'Rejected',
            ''.Constant::ORDER_STATUSES['Canceled']=>'Canceled',
            ''.Constant::ORDER_STATUSES['NotDelivered']=>'Not Delivered',
            ''.Constant::ORDER_STATUSES['NotReceived']=>'Not Received',
        ]
    ],
];
