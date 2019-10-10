<?php

namespace App\Http\Requests;

use App\Rules\NotRootSubject;
use App\Rules\UniqueOpinionsSubject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class OpinionsSubject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('opinion-subjects:connect');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'opinion_id' => ['required', new UniqueOpinionsSubject()],
            'subject_id' => ['required', new NotRootSubject()],
        ];
    }
}
