<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OpinionStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('opinions:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'opinion_scope_id' => 'required',
            'attorney_id' => 'required',
            'opinion_type_id' => 'required',
            'date' => 'required',
            'abstract' => 'required',
            'pdf_file' => 'mimes:pdf',
            'doc_file' => 'mimes:doc'
        ];
    }
}
