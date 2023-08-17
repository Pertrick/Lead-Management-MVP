<?php

namespace App\Http\Requests\Api\Lead;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;


class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
                'name' =>'sometimes',
                'email' => 'sometimes|email|unique:leads,email,NULL,id,user_id,' . auth()->id(),
                'status' => 'sometimes|in:unqualified,qualified,ready to close,won/lost,lost opportunity'
            ];
    }



}
