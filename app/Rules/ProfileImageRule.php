<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProfileImageRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
     //validationの成功判定
    public function passes($attribute, $value)
    {
        $path = pathinfo($value->getClientOriginalName());
        
        //ファイルの拡張子が「heic」か「HEIC」であればtrue
        return $path["extension"] == "heic" || $path["extension"] == "HEIC" || $path["extension"] == "JPG" || 
                $path["extension"] == "jpg" || $path["extension"] == "JPEG" || $path["extension"] == "PNG" ||
                $path["extension"] == "png";
    }
    
    

    /**
     * Get the validation error message.
     *
     * @return string
     */
     //エラーメッセージ
    public function message()
    {
        return trans('validation.profile_image');
    }
}
