<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'contact' => 'required|max:255',
            'message' => 'required|',
        ];
    }

    public function attributes()
    {
        return [
          'contact' => 'Телефон або email',
          'message' => 'Питання',
        ];
    }

    protected function getRedirectUrl()
    {
        $url = parent::getRedirectUrl();
        return $url . '#feedback';
    }
}
