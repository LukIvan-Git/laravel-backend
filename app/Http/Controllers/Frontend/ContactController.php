<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\ContactMailRequest;
use App\Models\ContactMail;
use App\Mail\ContactMailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class ContactController extends Controller
{
    public function sendContactMessage(ContactMailRequest $request)
    {
            
        $validated = $request->validated();
        //save the email to model (ContactMail)
        try {
            DB::beginTransaction();
            $contactMail = ContactMail::create($validated);
            $contactMail->save();
            Mail::to(env('MY_MAIL'))
            ->send(new ContactMailNotification($contactMail));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', trans('frontend.error_sending_message'))->withInput();
        }

        return redirect()->back()->with('success', trans('frontend.message_sent_successfully'));
    }
}
