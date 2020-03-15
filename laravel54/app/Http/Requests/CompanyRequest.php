<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'company.comName' => 'required',
            // 'company.address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'company.comName.required' => '公司名称不能为空',
            'company.address.required' => '公司地址不能为空'
        ];
    }
}
