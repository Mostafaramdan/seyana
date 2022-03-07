<?php
return [
    "permissions"=> [
        "statistics"=>[
                'name_ar'=>'الاحصائيات',
                'permissions'=>[                                       "view"=>true]
            ],
        "users"=>[
                'name_ar'=>'العملاء',
                'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
            ],
        "providers"=>[
                'name_ar'=>'مزودي الخدمات',
                'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
            ],

        "companies"=>[
            'name_ar'=>'الشركات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "orders"=>[
            'name_ar'=>'الطلبات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "categories"=>[
            'name_ar'=>'الاقسام',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "services"=>[
            'name_ar'=>'الخدمات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "regions"=>[
            'name_ar'=>'الدول / المدن / المناطق',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "contacts"=>[
            'name_ar'=>'الشكاوي والاقتراحات',
            'permissions'=>[                       'delete'=>true, 'view'=>true]
        ],

        "vouchers"=>[
            'name_ar'=>'أكواد الخصم',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

        "notifications"=>[
            'name_ar'=>'الاشعارات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],


        "currencies"=>[
            'name_ar'=>'العملات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],


        "app_settings"=>[
            'name_ar'=>'الاعدادات',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],


        "admins"=>[
            'name_ar'=>'المسؤولين',
            'permissions'=>['create'=>true,'update'=>true,'delete'=>true, 'view'=>true]
        ],

    ],
];

