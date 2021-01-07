<?php


return [

    'Admin'=>[
        'crud_names' => 'المدراء',
        'crud_name' => 'مدير',
        'crud_the_name' => 'المدير',
        'name' => 'الاسم',
        'email' => 'البريد الالكتروني',
        'is_active' => 'الحالة',
        'avatar' => 'الصورة',
    ],
    'User'=>[
        'crud_names' => 'المستخدمين',
        'crud_name' => 'مستخدم',
        'crud_the_name' => 'المستخدم',
        'name' => 'الاسم',
        'email' => 'البريد الالكتروني',
        'mobile' => 'رقم الجوال',
        'avatar' => 'الصورة',
        'type' => 'نوع البروفايل',
        'bio' => 'نبذة',
        'balance' => 'الرصيد',
        'favorite_car' => 'السيارة المفضلة',
        'app_locale' => 'اللغة',
        'is_active' => 'الحالة',
        'created_at' => 'تاريخ الإنشاء',
        'Links'=>[
            'active_mobile_email'=>'تفعيل الايميل والجوال'
        ]
    ],
    'Setting'=>[
        'crud_names' => 'الإعدادات',
        'crud_name' => 'اعداد',
        'crud_the_name' => 'الاعداد',
        'key' => 'الإعداد',
        'name' => 'الاسم',
        'name_ar' => 'الاسم عربي',
        'value' => 'القيمة',
        'value_ar' => 'القيمة عربي',
        'pages'=>'الصفحات الثابته',
        'notifications'=>'الاشعارات',
        'other'=>'اعدادات اخرى'
    ],
    'Faq'=>[
        'crud_names' => 'الأسئلة الشائعة',
        'crud_name' => 'سؤال شائع',
        'crud_the_name' => 'السؤال الشائع',
        'faq_category_id' => 'تصنيف الأسئلة الشائعة',
        'question' => 'السؤال',
        'question_ar' => 'السؤال عربي',
        'answer' => 'الإجابة',
        'answer_ar' => 'الإجابة عربي',
        'is_active' => 'الحالة',
    ],
    'Ticket'=>[
        'crud_names' => 'التذاكر',
        'crud_name' => 'تذكرة',
        'crud_the_name' => 'التذكرة',
        'id' => '#',
        'user_id' => 'المستخدم',
        'title' => 'العنوان',
        'message' => 'الرسالة',
        'ticket_response' => 'الرد',
        'response_form' => 'الرد على التذكرة',
        'status' => 'الحالة',
        'Statuses'=>[
            ''.\App\Helpers\Constant::TICKETS_STATUS['Open']=>'مفتوحة',
            ''.\App\Helpers\Constant::TICKETS_STATUS['Closed']=>'مغلقة',
        ]
    ],
    'Permission'=>[
        'crud_names' => 'الصلاحيات',
        'crud_name' => 'صلاحية',
        'crud_the_name' => 'الصلاحية',
        'id' => '#',
        'name' => 'الاسم',
    ],
    'Role'=>[
        'crud_names' => 'الأدوار',
        'crud_name' => 'دور',
        'crud_the_name' => 'الدور',
        'id' => '#',
        'name' => 'الاسم',
        'permissions' => 'الصلاحيات',
    ],
    'Subscription'=>[
        'crud_names' => 'الإشتراكات',
        'crud_name' => 'إشتراك',
        'crud_the_name' => 'الإشتراك',
        'name' => 'الإسم',
        'description' => 'الوصف',
        'name_ar' => 'الإسم عربي',
        'description_ar' => 'الوصف عربي',
        'gained_balance' => 'الرصيد المتاح',
        'price' => 'السعر',
        'is_active' => 'الحالة',
    ],
    'UserSubscription'=>[
        'crud_names' => 'الاشتراكات',
        'crud_name' => 'اشتراك',
        'crud_the_name' => 'الاشتراك',
        'user_id' => 'المستخدم',
        'subscription_id' => 'الاشتراك',
        'payment_method' => 'طريقة الدفع',
        'payment_detail' => 'بيانات الدفع',
        'status' => 'الحالة',
        'Statuses'=>[
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Pending']=>'بالانتظار',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Approved']=>'مقبول',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Rejected']=>'مرفوض',
            ''.\App\Helpers\Constant::SUBSCRIPTION_STATUSES['Canceled']=>'ملغي',
        ],
        'PaymentMethod'=>[
            \App\Helpers\Constant::PAYMENT_METHOD['BankTransfer']=>'حوالة بنكية',
            \App\Helpers\Constant::PAYMENT_METHOD['Cash']=>'كاش',
        ],
        'Links'=>[
            'approve'=>'قبول',
            'reject'=>'رفض',
            'cancel'=>'الغاء',
        ]
    ],
    'Transaction'=>[
        'crud_names' => 'الحركات المالية',
        'crud_name' => 'حركة مالية',
        'crud_the_name' => 'الحركة المالية',
        'user_id' => 'المستخدم',
        'value' => 'القيمة',
        'type' => 'نوع الحركة',
        'Types' => [
            '1'=>'إيداع',
            '2'=>'سحب',
            '3'=>'معلق',
        ],
        'payment_token' => 'كود الدفع',
        'ref_id' => 'العملية المرتبطة',
        'created_at' => 'التاريخ',
        'status' => 'الحالة',
    ],
    'Category'=>[
        'crud_names' => 'التصنيفات',
        'crud_name' => 'تصنيف',
        'crud_the_name' => 'التصنيف',
        'name' => 'الاسم',
        'name_ar' => 'الاسم عربي',
        'image' => 'الصورة',
        'is_active' => 'الحالة',
    ],
    'City'=>[
        'crud_names' => 'المدن',
        'crud_name' => 'مدينة',
        'crud_the_name' => 'المدينة',
        'name' => 'الاسم',
        'name_ar' => 'الاسم عربي',
        'is_active' => 'الحالة',
    ],
];
