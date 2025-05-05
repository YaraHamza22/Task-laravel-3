<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxWords implements ValidationRule
{
    protected int $maxWords;

    public function __construct(int $maxWords)
    {
      $this->maxWords = $maxWords;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
   public function validate(string $attribute, mixed $value, Closure $fail): void
    {
      $cleaned = trim(strip_tags($value));
      $words = preg_split('/\s+/u',$cleaned,-1,PREG_SPLIT_NO_EMPTY);
      if(count($words) > $this->maxWords){
        $fail("لا يجب ان يحتوي الحقل على اكثر من خمس كلمات".($this->maxWords));

      }
    }


    }


