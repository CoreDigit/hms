<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Department;
use App\Models\Cruds\DepartmentTranslation;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departmentsData = [
            [
                'name' => [
                    'en' => 'Medical-Surgical Department',
                    'ar' => 'القسم الجراحي الطبي',
                ],
                'description' => [
                    'en' => 'This department provides care to patients who require both medical and surgical treatments. It is equipped to handle a wide range of medical conditions and post-operative care.',
                    'ar' => 'يقدم هذا القسم الرعاية للمرضى الذين يحتاجون إلى علاجات طبية وجراحية. إنه مجهز للتعامل مع مجموعة واسعة من الحالات الطبية والرعاية بعد العمليات الجراحية.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Pediatrics Department',
                    'ar' => 'قسم طب الأطفال',
                ],
                'description' => [
                    'en' => 'The pediatrics department is dedicated to the care of infants, children, and adolescents. It provides specialized medical attention tailored to the unique needs of young patients.',
                    'ar' => 'يعنى قسم طب الأطفال برعاية الرضع والأطفال والمراهقين. يقدم اهتمامًا طبيًا متخصصًا يتم تصميمه وفقًا لاحتياجات المرضى الصغار.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Orthopedic Department',
                    'ar' => 'قسم العظام',
                ],
                'description' => [
                    'en' => 'The orthopedic department specializes in the diagnosis and treatment of musculoskeletal conditions, including bone fractures and joint disorders.',
                    'ar' => 'يتخصص قسم العظام في تشخيص وعلاج حالات الجهاز العظمي والعضلي، بما في ذلك كسور العظام واضطرابات المفاصل.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Cardiology Department',
                    'ar' => 'قسم القلبية',
                ],
                'description' => [
                    'en' => 'The cardiology department focuses on heart-related conditions and provides advanced cardiac care and monitoring for patients with heart problems.',
                    'ar' => 'يركز قسم القلبية على حالات القلب ويقدم رعاية ومراقبة قلبية متقدمة للمرضى الذين يعانون من مشكلات قلبية.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Maternity Department',
                    'ar' => 'قسم الولادة',
                ],
                'description' => [
                    'en' => 'The maternity department provides care and support for expectant mothers before, during, and after childbirth. It ensures a safe and comfortable environment for childbirth.',
                    'ar' => 'يقدم قسم الولادة الرعاية والدعم للأمهات الحوامل قبل الولادة وأثناءها وبعدها. يضمن بيئة آمنة ومريحة لعملية الولادة.',
                ],
            ],
        ];

        foreach ($departmentsData as $departmentData) {
            $department = new Department();
            $department->save();
            foreach (['en', 'ar'] as $locale) {
                $translation = new DepartmentTranslation([
                    'locale' => $locale,
                    'name' => $departmentData['name'][$locale],
                    'description' => $departmentData['description'][$locale],
                ]);
                $translation->department_id = $department->id;
                $translation->save();
            }
        }
    }
}
