<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctors',
        ],
        'labEmployee' => [
            'driver' => 'session',
            'provider' => 'labEmployees',
        ],
        'rayEmployee' => [
            'driver' => 'session',
            'provider' => 'rayEmployees',
        ],
        'patient' => [
            'driver' => 'session',
            'provider' => 'patients',
        ],
        'receptionist' => [
            'driver' => 'session',
            'provider' => 'receptionists',
        ],
        'nurse' => [
            'driver' => 'session',
            'provider' => 'nurses',
        ],
        'accountant' => [
            'driver' => 'session',
            'provider' => 'accountants',
        ],
        'pharmacist' => [
            'driver' => 'session',
            'provider' => 'pharmacists',
        ],
        'storeStaff' => [
            'driver' => 'session',
            'provider' => 'storeStaff',
        ],
        'hrStaff' => [
            'driver' => 'session',
            'provider' => 'hrStaff',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Admin::class,
        ],
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Doctor::class,
        ],
        'labEmployees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\LabEmployee::class,
        ],
        'rayEmployees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\RayEmployee::class,
        ],
        'patients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Patient::class,
        ],
        'receptionists' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Receptionist::class,
        ],
        'nurses' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Nurse::class,
        ],
        'accountants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Accountant::class,
        ],
        'pharmacists' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\Pharmacist::class,
        ],
        'storeStaff' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\StoreStaff::class,
        ],
        'hrStaff' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users\HrStaff::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
