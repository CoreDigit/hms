<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Statistics Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various statistics words.
    |
    */

    '' => 'Statistics',
    'financial' => 'Financial Statistics',

    'total' => [
        '' => 'Total',
        '*' => 'Totals',

        'price' => 'Total Price',
        'before_discount' => 'Total Before Discount',
        'after_discount' => 'Total After Discount',
        'with_tax' => 'Total With Tax',

        'due' => 'Total Due',
        'info' => 'Totals Information',

        'credit' => 'Total Credit',
        'debit' => 'Total Debit',

        'invoices' => 'Total Invoices',
        'payments' => 'Total Payments',
        'receipts' => 'Total Receipts',
        'accounts' => [
            'fund' => 'Total Fund Accounts',
            'patient' => 'Total Patient Accounts',
        ],
    ],

    'debit' => [
        '' => 'Debit',

        'invoices' => 'Debit Invoices',
        'accounts' => [
            'fund' => 'Debit Fund Accounts',
            'patient' => 'Debit Patient Accounts',
        ],
    ],

    'credit' => [
        '' => 'Credit',

        'invoices' => 'Credit Invoices',
        'accounts' => [
            'fund' => 'Credit Fund Accounts',
            'patient' => 'Credit Patient Accounts',
        ],
    ],

    'all' => [
        '' => 'All',

        'doctors' => 'All Doctors',
        'patients' => 'All Patients',
        'labEmployees' => 'All Lab Employees',
        'rayEmployees' => 'All Ray Employees',
        'ambulanceDrivers' => 'All Ambulance Drivers',

        'appointments' => 'All Appointments',
        'diagnostics' => 'All Diagnostics',
        'rays' => 'All Rays',
        'labs' => 'All Labs',

        'payments' => 'All Payments',
        'receipts' => 'All Receipts',

        'services' => [
            '' => 'All Services',
            'single' => 'All Single Services',
            'multi' => 'All Multi Services',
        ],
        'invoices' => [
            '' => 'All Invoices',
            'service' => [
                '' => 'All Service Invoices',
                'single' => 'All Single Service Invoices',
                'multi' => 'All Multi Service Invoices',
            ]
        ],
    ],

    'pending' => [
        '' => 'Pending',

        'appointments' => 'Pending Appointments',
        'diagnostics' => 'Pending Diagnostics',
        'rays' => 'Pending Rays',
        'labs' => 'Pending Labs',
    ],

    'in-progress' => [
        '' => 'In-Progress',

        'appointments' => 'In-Progress Appointments',
        'diagnostics' => 'In-Progress Diagnostics',
        'rays' => 'In-Progress Rays',
        'labs' => 'In-Progress Labs',
    ],

    'completed' => [
        '' => 'Completed',

        'appointments' => 'Completed Appointments',
        'diagnostics' => 'Completed Diagnostics',
        'rays' => 'Completed Rays',
        'labs' => 'Completed Labs',
    ],
];