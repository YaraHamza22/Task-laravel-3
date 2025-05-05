<?php

namespace App\Http\Requests;

use App\Rules\MaxWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
      return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                Rule::unique('posts','slug'),
                'regex:/^[a-z0-9\-]+$/',
                'max:255'
            ],

            'body' => ['required','string'],

            'is_published' => ['boolean'],

            'published_date' => ['nullable','date','after:now'],

            'meta_description' => ['nullable','string','max:160'],

            'tags' => ['nullable','array'],

            'tags.*' => ['string','max:50'],

            'keywords' => ['nullable','string',new MaxWords(5)],
        ];

    }
    public function messages()
    {
        return[
            'title.required' => 'الحقل الخاص بالعنوان مطلوب',
            'slug.regex' => 'يجب ان يحتوي على احرف صغيرة وارقام وواصلات فقط',
            'published_date.after'=> 'يجب ان يكون تاريخ النشر مستقبلي ',
            'keywords.max_words' => 'يجب ان لا تتجاوز الكلمات المفتاحية الخمس كلمات '
        ];
    }
    public function attributes()
    {
        return[
                    'title' => 'العنوان',
                    'slug' => 'الرابط',
                    'body' =>'المجتوى',
                    'published_date' => 'تاريخ النشر',

        ];

    }
    protected function prepareForValidation()
    {
        if(!$this->filled('slug')){
            $this->merge([
                'slug' => Str::slug($this->input('title')),
            ]);
        }

        if($this->filled('keywords')){

                $keywords = explode(',',$this->input('keywords'));
                $clean = implode(',', array_unique(array_map('trim',$keywords)));

                $this->merge([
                    'keywords' => $clean
                ]);
        }
}

  protected function passedValidation() : void
{
   $this->merge([

    'is_published' => filter_var($this->input('is_published',false), FILTER_VALIDATE_BOOLEAN)

   ]);
}

protected function failedValidation(Validator $validator)
{
 throw new HttpResponseException(
    response()->json([
        'status'=>'error',
        'messages' => 'التحقق فشل',
        'error' => $validator->errors()
    ],422)
);
}

}




