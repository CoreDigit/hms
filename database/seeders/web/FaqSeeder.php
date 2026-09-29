<?php

namespace Database\Seeders\web;

use App\Models\Web\Faq;
use App\Models\Web\FaqTranslation;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        // General faqs:
        $faqs = [
            [
                'en' => [
                    'question' => 'Can I use my doctor or any other doctor I choose?',
                    'answer' => 'Yes, you can choose your doctor or use your preferred doctor.',
                ],
                'ar' => [
                    'question' => 'هل يمكنني استخدام طبيبي الخاص أو أي طبيب آخر أختاره؟',
                    'answer' => 'نعم، يمكنك اختيار طبيبك الخاص أو استخدام أي طبيب تفضله.',
                ],
            ],
            [
                'en' => [
                    'question' => 'Do I need to register every doctor I go to?',
                    'answer' => 'No, you do not need to register every doctor you visit. You can choose to register or use the services as a guest.',
                ],
                'ar' => [
                    'question' => 'هل يجب علي تسجيل كل طبيب أزوره؟',
                    'answer' => 'لا، ليس عليك تسجيل كل طبيب تزوره. يمكنك اختيار التسجيل أو استخدام الخدمات كضيف.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do when I go to the doctor\'s office?',
                    'answer' => 'When you go to the doctor\'s office, make sure to bring any necessary medical records, insurance information, and a list of your current medications.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل عندما أذهب إلى عيادة الطبيب؟',
                    'answer' => 'عندما تذهب إلى عيادة الطبيب، تأكد من إحضار أي سجلات طبية ضرورية ومعلومات التأمين وقائمة بالأدوية التي تتناولها حاليًا.',
                ],
            ],
            [
                'en' => [
                    'question' => 'How much will my hospital stay cost?',
                    'answer' => 'The cost of your hospital stay can vary depending on various factors, including your insurance coverage and the type of treatment you receive. It is best to check with the hospital for cost estimates.',
                ],
                'ar' => [
                    'question' => 'كم ستكلفة إقامتي في المستشفى؟',
                    'answer' => 'تكلفة إقامتك في المستشفى يمكن أن تختلف اعتمادًا على عوامل متعددة، بما في ذلك تغطية التأمين الخاصة بك ونوع العلاج الذي تتلقاه. من الأفضل التحقق من التقديرات التكلفة لدى المستشفى.',
                ],
            ],
            [
                'en' => [
                    'question' => 'Can I choose my class of department?',
                    'answer' => 'Yes, you may have the option to choose your class of department, depending on availability and your preferences. Discuss this with the hospital staff during admission.',
                ],
                'ar' => [
                    'question' => 'هل يمكنني اختيار فئة غرفتي في المستشفى؟',
                    'answer' => 'نعم، قد تكون لديك خيار اختيار فئة غرفتك، اعتمادًا على التوافر وتفضيلاتك. قم بمناقشة ذلك مع موظفي المستشفى أثناء القبول.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What is a Patient Centered Medical Home?',
                    'answer' => "A Patient Centered Medical Home (PCMH) is a healthcare model that focuses on providing comprehensive, coordinated, and patient-centered care. It aims to improve the patient's overall health and well-being.",
                ],
                'ar' => [
                    'question' => 'ما هو مفهوم "المنزل الطبي المركزي للمرضى"؟',
                    'answer' => 'المنزل الطبي المركزي للمرضى (PCMH) هو نموذج رعاية صحية يركز على توفير رعاية شاملة ومنسقة ومركزة على المريض. يهدف إلى تحسين الصحة والرفاهية العامة للمريض.',
                ],
            ],
            [
                'en' => [
                    'question' => 'Why hospitals do not allow return medication?',
                    'answer' => 'Hospitals do not allow the return of medication due to safety and contamination concerns. Once a medication leaves the hospital pharmacy, it cannot be guaranteed to be sterile or safe for use by another patient.',
                ],
                'ar' => [
                    'question' => 'لماذا لا تسمح المستشفيات بإعادة الأدوية؟',
                    'answer' => 'المستشفيات لا تسمح بإعادة الأدوية بسبب مخاوف السلامة والتلوث. بمجرد أن تغادر الدواء صيدلية المستشفى، لا يمكن ضمان أنه نظيف أو آمن للاستخدام من قبل مريض آخر.',
                ],
            ],
            [
                'en' => [
                    'question' => 'How are my medical bills paid?',
                    'answer' => 'Your medical bills may be paid through various methods, including insurance, out-of-pocket payments, or third-party payers. It depends on your insurance coverage and the specific services received.',
                ],
                'ar' => [
                    'question' => 'كيف يتم دفع فواتير الرعاية الصحية الخاصة بي؟',
                    'answer' => 'فواتير الرعاية الصحية الخاصة بك يمكن أن تتم دفعها من خلال طرق متعددة، بما في ذلك التأمين الصحي والدفع الخارجي أو جهات دفع طرف ثالث. ذلك يعتمد على تغطية التأمين الخاصة بك والخدمات الخاصة التي تم تلقيها.',
                ],
            ],
        ];

        foreach ($faqs as $faqData) {
            $faq = Faq::create();

            foreach (['en', 'ar'] as $locale) {
                FaqTranslation::create([
                    'faq_id' => $faq->id,
                    'locale' => $locale,
                    'question' => $faqData[$locale]['question'],
                    'answer' => $faqData[$locale]['answer'],
                ]);
            }
        }

        /********************************************/

        // Urgent faqs:
        $faqs = [
            [
                'en' => [
                    'question' => 'What should I do if I am having a heart attack?',
                    'answer' => 'Call 911 immediately. If you are with someone who is having a heart attack, help them to sit down comfortably and loosen any tight clothing. Stay with them until help arrives.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت أعاني من نوبة قلبية؟',
                    'answer' => 'اتصل برقم 911 على الفور. إذا كنت مع شخص يعاني من نوبة قلبية، فاساعده على الجلوس بشكل مريح وفك أي ملابس ضيقة. ابق معه حتى يصل المسعفون.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do if I am experiencing chest pain?',
                    'answer' => 'Call 911 or go to the nearest emergency room. Chest pain can be a sign of a heart attack, so it is important to seek medical attention immediately.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت أعاني من ألم في الصدر؟',
                    'answer' => 'اتصل برقم 911 أو اذهب إلى أقرب غرفة طوارئ. يمكن أن يكون ألم الصدر علامة على نوبة قلبية، لذلك من المهم طلب المساعدة الطبية على الفور.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do if I am having trouble breathing?',
                    'answer' => 'Call 911 or go to the nearest emergency room. Trouble breathing can be a sign of a serious medical condition, such as an asthma attack or a heart attack. It is important to seek medical attention immediately.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت أعاني من صعوبة في التنفس؟',
                    'answer' => 'اتصل برقم 911 أو اذهب إلى أقرب غرفة طوارئ. يمكن أن تكون صعوبة التنفس علامة على حالة طبية خطيرة، مثل نوبة الربو أو نوبة قلبية. من المهم طلب المساعدة الطبية على الفور.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do if I am bleeding heavily?',
                    'answer' => 'Apply pressure to the wound with a clean cloth or bandage. If the bleeding does not stop, call 911 or go to the nearest emergency room.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت أنزف بشدة؟',
                    'answer' => 'ضع ضغطًا على الجرح بقطعة قماش نظيفة أو ضمادة. إذا لم يتوقف النزيف، فاتصل برقم 911 أو اذهب إلى أقرب غرفة طوارئ.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do if I am having a seizure?',
                    'answer' => 'Clear the area around the person having the seizure. Remove any objects that could harm the person. If the seizure lasts longer than five minutes, call 911.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت أعاني من نوبة صرع؟',
                    'answer' => 'قم بإخلاء المنطقة المحيطة بالشخص الذي يعاني من النوبة. قم بإزالة أي أجسام قد تؤذي الشخص. إذا استمرت النوبة لأكثر من خمس دقائق، فاتصل برقم 911.',
                ],
            ],
            [
                'en' => [
                    'question' => 'What should I do if I am unconscious?',
                    'answer' => 'Check for breathing and a pulse. If the person is not breathing, start CPR. If the person has a pulse but is not breathing, rescue breathing. Call 911 immediately.',
                ],
                'ar' => [
                    'question' => 'ماذا يجب أن أفعل إذا كنت فاقدًا للوعي؟',
                    'answer' => 'تحقق من التنفس والنبض. إذا لم يكن الشخص يتنفس، ابدأ الإنعاش القلبي الرئوي. إذا كان لدى الشخص نبض ولكنه لا يتنفس، فقم بالتنفس الاصطناعي.',
                ],
            ],
        ];

        foreach ($faqs as $faqData) {
            $faq = Faq::create([
                'category' => 'urgent',
            ]);

            foreach (['en', 'ar'] as $locale) {
                FaqTranslation::create([
                    'faq_id' => $faq->id,
                    'locale' => $locale,
                    'question' => $faqData[$locale]['question'],
                    'answer' => $faqData[$locale]['answer'],
                ]);
            }
        }
    }
}
