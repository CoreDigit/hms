<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Insurance;
use App\Models\Cruds\InsuranceTranslation;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    public function run()
    {
        $insurancesData = [
            [
                'name' => [
                    'en' => 'National Health Insurance',
                    'ar' => 'التأمين الصحي الوطني',
                ],
                'code' => 'NHI',
                'discount_percentage' => 10,
                'description' => [
                    'en' => 'A government-funded health insurance program that provides basic health coverage to all citizens.',
                    'ar' => 'برنامج تأمين صحي تموله الحكومة يوفر تغطية صحية أساسية لجميع المواطنين.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Blue Cross Blue Shield',
                    'ar' => 'بلو كروس بلو شيلد',
                ],
                'code' => 'BCBS',
                'discount_percentage' => 20,
                'description' => [
                    'en' => 'A non-profit health insurance company that offers a variety of health insurance plans to individuals and families.',
                    'ar' => 'شركة تأمين صحي غير ربحية تقدم مجموعة متنوعة من الخطط التأمينية الصحية للأفراد والأسر.',
                ],
            ],
            [
                'name' => [
                    'en' => 'UnitedHealthcare',
                    'ar' => 'يونايتد هيلث كير',
                ],
                'code' => 'UHC',
                'discount_percentage' => 30,
                'description' => [
                    'en' => 'One of the largest health insurance companies in the United States, offering a variety of health insurance plans to individuals and families.',
                    'ar' => 'واحدة من أكبر شركات التأمين الصحي في الولايات المتحدة، وتقدم مجموعة متنوعة من الخطط التأمينية الصحية للأفراد والأسر.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Aetna',
                    'ar' => 'إيتنا',
                ],
                'code' => 'AETNA',
                'discount_percentage' => 40,
                'description' => [
                    'en' => 'A health insurance company that offers a variety of health insurance plans to individuals and families, as well as Medicare and Medicaid plans.',
                    'ar' => 'شركة تأمين صحي تقدم مجموعة متنوعة من الخطط التأمينية الصحية للأفراد والأسر، بالإضافة إلى خطط Medicare و Medicaid.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Cigna',
                    'ar' => 'سيغنا',
                ],
                'code' => 'CIGNA',
                'discount_percentage' => 50,
                'description' => [
                    'en' => 'A global health services company that offers a variety of health insurance plans to individuals and families, as well as group health insurance plans for employers.',
                    'ar' => 'شركة عالمية للخدمات الصحية تقدم مجموعة متنوعة من الخطط التأمينية الصحية للأفراد والأسر، بالإضافة إلى خطط التأمين الصحي الجماعي لأصحاب العمل.',
                ],
            ],
        ];
        
        foreach ($insurancesData as $insuranceData) {
            $insurance = new Insurance([
                'status' => true,
                'code' => $insuranceData['code'],
                'discount_percentage' => $insuranceData['discount_percentage'],
            ]);
            $insurance->save();

            foreach (['en', 'ar'] as $locale) {
                $translation = new InsuranceTranslation([
                    'locale' => $locale,
                    'name' => $insuranceData['name'][$locale],
                    'description' => $insuranceData['description'][$locale],
                ]);
                $translation->insurance_id = $insurance->id;
                $translation->save();
            }
        }
    }
}
