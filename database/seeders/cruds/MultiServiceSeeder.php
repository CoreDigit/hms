<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\MultiService;
use App\Models\Cruds\MultiServiceTranslation;
use App\Models\Cruds\Service;
use Illuminate\Database\Seeder;

class MultiServiceSeeder extends Seeder
{
    public function run(): void
    {
        $multiServicesData = [
            [
                'name' => [
                    'en' => 'Daily Check Up',
                    'ar' => 'الفحص اليومي',
                ],
                'description' => [
                    'en' => 'Daily health checkup to monitor your well-being.',
                    'ar' => 'فحص صحي يومي لمراقبة رفاهيتك.',
                ],
                'single_service_ids' => [1, 2],
                'total_price' => 200 + 150,
                'discount_value' => 5,
                'tax_rate' => 17,
            ],
            [
                'name' => [
                    'en' => 'Monthly Check Up',
                    'ar' => 'الفحص الشهري',
                ],
                'description' => [
                    'en' => 'Monthly health checkup to track your health progress.',
                    'ar' => 'فحص صحي شهري لتتبع تقدم صحتك.',
                ],
                'single_service_ids' => [1, 2, 3, 4],
                'total_price' => 200 + 150 + 50 + 100,
                'discount_value' => 8,
                'tax_rate' => 17,
            ],
            [
                'name' => [
                    'en' => 'Yearly Check Up',
                    'ar' => 'الفحص السنوي',
                ],
                'description' => [
                    'en' => 'Comprehensive yearly health checkup including all available services.',
                    'ar' => 'فحص صحي سنوي شامل يشمل جميع الخدمات المتاحة.',
                ],
                'single_service_ids' => [1, 2, 3, 4, 5, 6],
                'total_price' => 200 + 150 + 50 + 100 + 75 + 120,
                'discount_value' => 15,
                'tax_rate' => 17,
            ],
            //////////
            [
                'name' => [
                    'en' => 'General Health Package',
                    'ar' => 'حزمة الفحص الصحي العام',
                ],
                'description' => [
                    'en' => 'Comprehensive health checkup including X-ray, blood test, and consultation.',
                    'ar' => 'فحص صحي شامل يشمل أشعة سينية واختبار الدم واستشارة طبية.',
                ],
                'single_service_ids' => [7, 8, 9],
                'total_price' => 100 + 150 + 75,
                'discount_value' => 10,
                'tax_rate' => 17,
            ],
            [
                'name' => [
                    'en' => 'Dental Care Package',
                    'ar' => 'حزمة الرعاية الصحية للأسنان',
                ],
                'description' => [
                    'en' => 'Complete dental care including cleaning, filling, and oral hygiene education.',
                    'ar' => 'رعاية صحة الأسنان الكاملة بما في ذلك التنظيف والحشو وتثقيف الصحة الفموية.',
                ],
                'single_service_ids' => [10, 11],
                'total_price' => 300 + 50,
                'discount_value' => 5,
                'tax_rate' => 17,
            ],
            [
                'name' => [
                    'en' => 'Maternity Package',
                    'ar' => 'حزمة الأمومة',
                ],
                'description' => [
                    'en' => 'Comprehensive maternity care for expectant mothers, including prenatal checkups and delivery.',
                    'ar' => 'رعاية شاملة للأمهات الحوامل، بما في ذلك الفحوصات الروتينية أثناء الحمل وعمليات الولادة.',
                ],
                'single_service_ids' => [7, 9, 11],
                'total_price' => 100 + 75 + 50,
                'discount_value' => 20,
                'tax_rate' => 11,
            ],
            [
                'name' => [
                    'en' => 'Emergency Care Package',
                    'ar' => 'حزمة الرعاية الطارئة',
                ],
                'description' => [
                    'en' => 'Immediate medical assistance in case of emergencies and accidents.',
                    'ar' => 'مساعدة طبية فورية في حالات الطوارئ والحوادث.',
                ],
                'single_service_ids' => [8, 9],
                'total_price' => 150 + 75,
                'discount_value' => 15,
                'tax_rate' => 13,
            ],
            [
                'name' => [
                    'en' => "Children's Health Package",
                    'ar' => 'حزمة صحة الأطفال',
                ],
                'description' => [
                    'en' => 'Comprehensive health checkup and vaccinations for children.',
                    'ar' => 'فحص صحي شامل وتطعيمات للأطفال.',
                ],
                'single_service_ids' => [10],
                'total_price' => 300,
                'discount_value' => 20,
                'tax_rate' => 15,
            ],
        ];

        foreach ($multiServicesData as $multiServiceData) {
            $service = Service::create([
                'type' => 'multi',
                'price' => 0,
            ]);

            $multiService = MultiService::create([
                'service_id' => $service->id,
                'total_price' => $multiServiceData['total_price'],
                'discount_value' => $multiServiceData['discount_value'],
                'tax_rate' => $multiServiceData['tax_rate'],
            ]);

            $service->update(['price' => $multiService->getTotalWithTax()]);
            $multiService->singleServices()->sync($multiServiceData['single_service_ids']);

            foreach (['en', 'ar'] as $locale) {
                MultiServiceTranslation::create([
                    'locale' => $locale,
                    'multi_service_id' => $multiService->id,
                    'name' => $multiServiceData['name'][$locale],
                    'description' => $multiServiceData['description'][$locale],
                ]);
            }
        }
    }
}
