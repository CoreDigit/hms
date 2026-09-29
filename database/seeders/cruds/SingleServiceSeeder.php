<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Service;
use App\Models\Cruds\SingleService;
use App\Models\Cruds\SingleServiceTranslation;
use Illuminate\Database\Seeder;

class SingleServiceSeeder extends Seeder
{
    public function run(): void
    {
        $singleServicesData = [
            [
                'name' => [
                    'en' => 'Review of Safety Program',
                    'ar' => 'مراجعة برنامج السلامة',
                ],
                'description' => [
                    'en' => 'A comprehensive review of the safety program.',
                    'ar' => 'مراجعة شاملة لبرنامج السلامة.',
                ],
                'price' => 200,
            ],
            [
                'name' => [
                    'en' => 'Annual Sexual Harassment Training',
                    'ar' => 'تدريب سنوي على مكافحة التحرش الجنسي',
                ],
                'description' => [
                    'en' => 'Yearly training to prevent sexual harassment in the workplace.',
                    'ar' => 'تدريب سنوي لمنع التحرش الجنسي في مكان العمل.',
                ],
                'price' => 150,
            ],
            [
                'name' => [
                    'en' => 'Monthly Newsletter',
                    'ar' => 'النشرة الشهرية',
                ],
                'description' => [
                    'en' => 'Monthly newsletter with updates and information.',
                    'ar' => 'نشرة شهرية تحتوي على التحديثات والمعلومات.',
                ],
                'price' => 50,
            ],
            [
                'name' => [
                    'en' => 'Safety Training Topics',
                    'ar' => 'مواضيع تدريب السلامة',
                ],
                'description' => [
                    'en' => 'Training on various safety topics.',
                    'ar' => 'تدريب على مواضيع السلامة المتنوعة.',
                ],
                'price' => 100,
            ],
            [
                'name' => [
                    'en' => 'Monthly health check-ups',
                    'ar' => 'فحوصات صحية شهرية',
                ],
                'description' => [
                    'en' => 'Regular health check-ups on a monthly basis.',
                    'ar' => 'فحوصات صحية منتظمة شهرياً.',
                ],
                'price' => 75,
            ],
            [
                'name' => [
                    'en' => 'Early illness diagnoses',
                    'ar' => 'تشخيص الأمراض المبكرة',
                ],
                'description' => [
                    'en' => 'Diagnosis and detection of illnesses in their early stages.',
                    'ar' => 'تشخيص واكتشاف الأمراض في مراحلها البدائية.',
                ],
                'price' => 120,
            ],
            //////////
            [
                'name' => [
                    'en' => 'General Checkup',
                    'ar' => 'فحص عام',
                ],
                'description' => [
                    'en' => 'A routine checkup to assess your overall health.',
                    'ar' => 'فحص دوري لتقييم صحتك العامة.',
                ],
                'price' => 100,
            ],
            [
                'name' => [
                    'en' => 'X-Ray Examination',
                    'ar' => 'فحص أشعة سينية',
                ],
                'description' => [
                    'en' => 'Radiological imaging to diagnose various medical conditions.',
                    'ar' => 'صور تصويرية لتشخيص مختلف الحالات الطبية.',
                ],
                'price' => 150,
            ],
            [
                'name' => [
                    'en' => 'Blood Test',
                    'ar' => 'اختبار الدم',
                ],
                'description' => [
                    'en' => 'Analysis of blood samples to detect illnesses and infections.',
                    'ar' => 'تحليل عينات الدم لاكتشاف الأمراض والعدوى.',
                ],
                'price' => 75,
            ],
            [
                'name' => [
                    'en' => 'Maternity Care',
                    'ar' => 'رعاية الأمومة',
                ],
                'description' => [
                    'en' => 'Comprehensive care for expectant mothers during pregnancy and childbirth.',
                    'ar' => 'رعاية شاملة للأمهات الحوامل خلال فترة الحمل والولادة.',
                ],
                'price' => 300,
            ],
            [
                'name' => [
                    'en' => 'Dental Cleaning',
                    'ar' => 'تنظيف الأسنان',
                ],
                'description' => [
                    'en' => 'Professional dental cleaning to maintain oral hygiene.',
                    'ar' => 'تنظيف الأسنان المهني للحفاظ على نظافة الفم.',
                ],
                'price' => 50,
            ],
        ];
        
        foreach ($singleServicesData as $singleServiceData) {
            $service = Service::create([
                'type' => 'single',
                'price' => $singleServiceData['price'],
            ]);
            $singleService = SingleService::create([
                'service_id' => $service->id,
            ]);
            foreach (['en', 'ar'] as $locale) {
                SingleServiceTranslation::create([
                    'locale' => $locale,
                    'single_service_id' => $singleService->id,
                    'name' => $singleServiceData['name'][$locale],
                    'description' => $singleServiceData['description'][$locale],
                ]);
            }
        }
    }
}
