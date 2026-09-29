<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cruds\MultiService;
use App\Models\Cruds\Service;
use App\Models\Cruds\Department;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use App\Models\Web\Faq;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /********************************** Home **********************************/

    public function index()
    {
        $count = $this->getStatistics();
        $departments = Department::take(6)->get();
        $doctors = Doctor::take(4)->get();
        $patients = Patient::take(6)->get();
        return view('frontend.pages.index', compact('departments', 'count', 'doctors', 'patients'));
    }

    public function getStatistics()
    {
        return [
            'patients' => Patient::count(),
            'doctors' => Doctor::count(),
            'departments' => Department::count(),
            'services' => Service::count(),
        ];
    }

    /********************************** Services **********************************/

    public function indexServices()
    {
        $multiServices = MultiService::all();
        return view('frontend.pages.services', compact('multiServices'));
    }

    public function showMultiService(MultiService $multiService)
    {
        return view('frontend.pages.multi-service', compact('multiService'));
    }
    
    /********************************** Appointments **********************************/

    public function createAppointment()
    {
        $multiServices = MultiService::take(3)->get();
        return view('frontend.pages.appointments', compact('multiServices'));
    }

    /********************************** Contact **********************************/

    public function createContact()
    {
        return view('frontend.pages.contact');
    }

    public function storeContact(Request $request)
    {
        session()->flash('sent');
        return back();
    }

    /********************************** About **********************************/

    public function showAbout()
    {
        $count = $this->getStatistics();
        return view('frontend.pages.about', compact('count'));
    }

    public function showFaq()
    {
        $general_faqs = Faq::where('category', 'general')->get()->split(2);
        $urgent_faqs = Faq::where('category', 'urgent')->get()->split(2);
        return view('frontend.pages.faq', compact('general_faqs', 'urgent_faqs'));
    }

    public function storeAsk(Request $request)
    {
        session()->flash('sent');
        return back();
    }
}
