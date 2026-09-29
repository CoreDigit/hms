<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    /************************ Mine ************************/

    'created' => 'تمت إضافة البيانات بنجاح',
    'create_error' => 'حدث خطأ أثناء إضافة البيانات. يرجى المحاولة مرة أخرى.',
    'updated' => 'تم تحديث البيانات بنجاح',
    'update_error' => 'حدث خطأ أثناء تحديث البيانات. يرجى المحاولة مرة أخرى.',
    'deleted' => 'تم حذف البيانات بنجاح',
    'delete_error' => 'حدث خطأ أثناء حذف البيانات. يرجى المحاولة مرة أخرى.',
    'password_updated' => 'تم تحديث كلمة المرور بنجاح',
    'password_error' => 'كلمة المرور غير صحيحة! يرجى المحاولة مرة أخرى.',
    'activated' => 'تم تنشيط المستخدم بنجاح',
    'active_error' => 'حدث خطأ أثناء تنشيط المستخدم. يرجى المحاولة مرة أخرى.',
    'inactivated' => 'تم إلغاء تنشيط المستخدم بنجاح',
    'inactive_error' => 'حدث خطأ أثناء إلغاء تنشيط المستخدم. يرجى المحاولة مرة أخرى.',

    'sent' => 'تم إرسال الطلب بنجاح.',
    'patient' => 'يجب عليك تسجيل الدخول كمريض أولاً!',
    'appointment' => [
        'booked' => 'تم حجز الموعد بنجاح',
        'there' => 'لديك بالفعل موعد مع هذا الطبيب',
        'date_error' => 'لا يمكنك حجز موعد في هذا التاريخ',
    ],
    'error' => [
        '' => 'خطأ',
        'message' => [
            "عذرًا. الصفحة التي كنت تبحث عنها غير موجودة.",
            "قد تكون قد أدخلت العنوان بشكل خاطئ أو ربما تم نقل الصفحة."
        ],
        'redirect' => 'العودة إلى الصفحة الرئيسية',
    ],

    /*********************** /Mine ************************/

    'accepted' => 'يجب قبول حقل :attribute.',
    'accepted_if' => 'يجب قبول حقل :attribute عندما يكون :other هو :value.',
    'active_url' => 'حقل :attribute يجب أن يكون عنوان URL صالحًا.',
    'after' => 'حقل :attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal' => 'حقل :attribute يجب أن يكون تاريخًا بعد أو مساويًا لـ :date.',
    'alpha' => 'حقل :attribute يجب أن يحتوي فقط على حروف.',
    'alpha_dash' => 'حقل :attribute يجب أن يحتوي فقط على حروف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => 'حقل :attribute يجب أن يحتوي فقط على حروف وأرقام.',
    'array' => 'حقل :attribute يجب أن يكون مصفوفة.',
    'ascii' => 'حقل :attribute يجب أن يحتوي فقط على أحرف أبجدية وأرقام ورموز فقط.',
    'before' => 'حقل :attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal' => 'حقل :attribute يجب أن يكون تاريخًا قبل أو مساويًا لـ :date.',
    'between' => [
        'array' => 'حقل :attribute يجب أن يحتوي بين :min و :max عنصرًا.',
        'file' => 'حقل :attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون بين :min و :max.',
        'string' => 'حقل :attribute يجب أن يكون بين :min و :max حرفًا.',
    ],
    'boolean' => 'حقل :attribute يجب أن يكون صحيحًا أو خاطئًا.',
    'can' => 'حقل :attribute يحتوي على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد الحقل :attribute غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'حقل :attribute يجب أن يكون تاريخًا صالحًا.',
    'date_equals' => 'حقل :attribute يجب أن يكون تاريخًا مساويًا لـ :date.',
    'date_format' => 'حقل :attribute يجب أن يتطابق مع التنسيق :format.',
    'decimal' => 'حقل :attribute يجب أن يحتوي على :decimal على الأقل.',
    'declined' => 'يجب رفض حقل :attribute.',
    'declined_if' => 'يجب رفض حقل :attribute عندما يكون :other هو :value.',
    'different' => 'حقل :attribute و :other يجب أن يكونا مختلفين.',
    'digits' => 'حقل :attribute يجب أن يحتوي على :digits أرقام.',
    'digits_between' => 'حقل :attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions' => 'حقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'حقل :attribute يجب ألا ينتهي بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'حقل :attribute يجب ألا يبدأ بأحد القيم التالية: :values.',
    'email' => 'حقل :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => 'حقل :attribute يجب أن ينتهي بأحد القيم التالية: :values.',
    'enum' => 'القيمة المحددة :attribute غير صحيحة.',
    'exists' => 'القيمة المحددة :attribute غير صحيحة.',
    'file' => 'حقل :attribute يجب أن يكون ملفًا.',
    'filled' => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => 'حقل :attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => 'حقل :attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أكبر من :value.',
        'string' => 'حقل :attribute يجب أن يكون أكبر من :value حرفًا.',
    ],
    'gte' => [
        'array' => 'حقل :attribute يجب أن يحتوي على :value عنصرًا أو أكثر.',
        'file' => 'حقل :attribute يجب أن يكون أكبر من أو مساويًا لـ :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أكبر من أو مساويًا لـ :value.',
        'string' => 'حقل :attribute يجب أن يكون أكبر من أو مساويًا لـ :value حرفًا.',
    ],
    'image' => 'حقل :attribute يجب أن يكون صورة.',
    'in' => 'القيمة المحددة :attribute غير صحيحة.',
    'in_array' => 'حقل :attribute يجب أن يكون موجودًا في :other.',
    'integer' => 'حقل :attribute يجب أن يكون عددًا صحيحًا.',
    'ip' => 'حقل :attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4' => 'حقل :attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6' => 'حقل :attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'json' => 'حقل :attribute يجب أن يكون سلسلة JSON صالحة.',
    'lowercase' => 'حقل :attribute يجب أن يكون في الحالة الصغيرة.',
    'lt' => [
        'array' => 'حقل :attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => 'حقل :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون أقل من :value.',
        'string' => 'حقل :attribute يجب أن يكون أقل من :value حرفًا.',
    ],
    'lte' => [
        'array' => 'حقل :attribute يجب ألا يحتوي على أكثر من :value عنصرًا.',
        'file' => 'حقل :attribute يجب ألا يكون أكبر من أو مساويًا لـ :value كيلوبايت.',
        'numeric' => 'حقل :attribute يجب ألا يكون أكبر من أو مساويًا لـ :value.',
        'string' => 'حقل :attribute يجب ألا يكون أكبر من أو مساويًا لـ :value حرفًا.',
    ],
    'mac_address' => 'حقل :attribute يجب أن يكون عنوان MAC صالحًا.',
    'max' => [
        'array' => 'حقل :attribute يجب ألا يحتوي على أكثر من :max عنصر.',
        'file' => 'حقل :attribute يجب ألا يكون أكبر من :max كيلوبايت.',
        'numeric' => 'حقل :attribute يجب ألا يكون أكبر من :max.',
        'string' => 'حقل :attribute يجب ألا يكون أكبر من :max حرفًا.',
    ],
    'max_digits' => 'حقل :attribute يجب ألا يحتوي على أكثر من :max أرقام.',
    'mimes' => 'حقل :attribute يجب أن يكون نوع الملف: :values.',
    'mimetypes' => 'حقل :attribute يجب أن يكون نوع الملف: :values.',
    'min' => [
        'array' => 'حقل :attribute يجب أن يحتوي على الأقل على :min عنصر.',
        'file' => 'حقل :attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون على الأقل :min.',
        'string' => 'حقل :attribute يجب أن يكون على الأقل :min حرفًا.',
    ],
    'min_digits' => 'حقل :attribute يجب أن يحتوي على الأقل على :min أرقام.',
    'missing' => 'يجب أن يكون حقل :attribute مفقودًا.',
    'missing_if' => 'يجب أن يكون حقل :attribute مفقودًا عندما يكون :other هو :value.',
    'missing_unless' => 'يجب أن يكون حقل :attribute مفقودًا ما لم يكن :other هو :value.',
    'missing_with' => 'يجب أن يكون حقل :attribute مفقودًا عندما يكون :values موجودًا.',
    'missing_with_all' => 'يجب أن يكون حقل :attribute مفقودًا عندما تكون :values موجودة.',
    'multiple_of' => 'حقل :attribute يجب أن يكون مضاعفًا للقيمة :value.',
    'not_in' => 'القيمة المحددة :attribute غير صحيحة.',
    'not_regex' => 'تنسيق حقل :attribute غير صالح.',
    'numeric' => 'حقل :attribute يجب أن يكون رقمًا.',
    'password' => [
        'letters' => 'يجب أن يحتوي حقل :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي حقل :attribute على حرف كبير وحرف صغير واحد على الأقل.',
        'numbers' => 'يجب أن يحتوي حقل :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي حقل :attribute على رمز واحد على الأقل.',
        'uncompromised' => 'القيمة :attribute المُعطاة ظهرت في تسريب بيانات. يرجى اختيار :attribute مختلفًا.',
    ],
    'present' => 'حقل :attribute يجب أن يكون موجودًا.',
    'prohibited' => 'حقل :attribute ممنوع.',
    'prohibited_if' => 'حقل :attribute ممنوع عندما يكون :other هو :value.',
    'prohibited_unless' => 'حقل :attribute ممنوع ما لم يكن :other موجودًا في :values.',
    'prohibits' => 'حقل :attribute يمنع :other من التواجد.',
    'regex' => 'تنسيق حقل :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'حقل :attribute يجب أن يحتوي على مفاتيح للمدخلات: :values.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => 'حقل :attribute مطلوب ما لم يكن :other موجودًا في :values.',
    'required_with' => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_with_all' => 'حقل :attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => 'حقل :attribute مطلوب عندما لا تكون :values موجودة.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same' => 'حقل :attribute يجب أن يتطابق مع :other.',
    'size' => [
        'array' => 'حقل :attribute يجب أن يحتوي على :size عنصر.',
        'file' => 'حقل :attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => 'حقل :attribute يجب أن يكون :size.',
        'string' => 'حقل :attribute يجب أن يكون :size حرفًا.',
    ],
    'starts_with' => 'حقل :attribute يجب أن يبدأ بأحد القيم التالية: :values.',
    'string' => 'حقل :attribute يجب أن يكون سلسلة نصية.',
    'timezone' => 'حقل :attribute يجب أن يكون منطقة زمنية صالحة.',
    'unique' => 'تم أخذ القيمة :attribute بالفعل.',
    'uploaded' => 'فشل في رفع القيمة :attribute.',
    'uppercase' => 'حقل :attribute يجب أن يكون في الحالة الكبيرة.',
    'url' => 'حقل :attribute يجب أن يكون عنوان URL صالح.',
    'ulid' => 'حقل :attribute يجب أن يكون ULID صالحًا.',
    'uuid' => 'حقل :attribute يجب أن يكون UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'gender' => 'الجنس',
        'phone' => 'الهاتف',
        'specialty' => 'التخصص',
        'department' => 'القسم',
        'number_of_appointments' => 'عدد المواعيد',
        'image' => 'الصورة',
        'current_password' => 'كلمة المرور الحالية.',
        'department_id' => 'القسم',

        'patient_id' => 'المريض',
        'doctor_id' => 'الطبيب',
        'service_id' => 'الخدمة',
        'case' => 'الحالة',
        'amount' => 'الكمية',

        'type' => 'النوع',
        'number' => 'الرقم',
        'model' => 'الموديل',
        'year_made' => 'سنة الصنع',

        'code' => 'الكود',
        'discount_percentage' => 'نسبة الخصم',

        'time' => 'الوقت',
        'diagnosis' => 'التشخيص',
        'description' => 'الوصف',
    ],
];
