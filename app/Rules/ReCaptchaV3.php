<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ReCaptchaV3 implements ValidationRule
{
    public function __construct(
        private ?string $action = null,
        private ?float $minScore = null) {}

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Send a POST request to the google siteverify service to validate the
        $recaptcha = "";

        if(env('APP_ENV')!='local') {
            $recaptcha = Http::asForm()
            ->post(env('GOOGLE_RECAPTCHA_URL'), [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
                'response' => $value,
            ]);
        }
        
        $recaptcha = Http::withoutVerifying()->asForm()
            ->post(env('GOOGLE_RECAPTCHA_URL'), [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
                'response' => $value,
            ]);

        $recaptcha = $recaptcha->object();
        if ($recaptcha->success == false) {
            $fail(implode(', ', $recaptcha->{'error-codes'}));

            return;
        }

        if (! is_null($this->action) && $this->action != $recaptcha->action) {
            $fail('The action found in the form didn\'t match the Google reCAPTCHA action, please try again.');

            return;
        }

        if (! is_null($this->minScore) && $this->minScore > $recaptcha->score) {
            $fail('The Google reCAPTCHA verification score was too low, please try again.');

            return;
        }
    }
}
