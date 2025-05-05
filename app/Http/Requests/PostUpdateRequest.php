<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use Illuminate\Validation\Rule;


class PostUpdateRequest extends PostStoreRequest
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
            return array_merge(parent::rules(),[


            'slug' => [
                'nullable',
                'string',
                Rule::unique('posts','slug')->ignore($this->post),
                'regex:/^[a-z0-9\-]+$/',
                'max:255'
            ],

            'is_published' => ['boolean'],

            'published_date' => ['nullable','date','after:now'],


        ]);

    }
    public function messages()
    {
        return[

            'slug.regex' => 'يجب ان يحتوي على احرف صغيرة وارقام وواصلات فقط',
            'published_date.after'=> 'يجب ان يكون تاريخ النشر مستقبلي ',

        ];
    }
    public function attributes()
    {
        return[
                    'slug' => 'الرابط',
                    'published_date' => 'تاريخ النشر',

        ];

    }
    protected function prepareForValidation():void
    {
       if(!$this->input('published_date')){
        $this->merge([
            'published_date' => now(),
        ]);
        $post = $this->route('posts');
       }
    }

}
