<?php

namespace App\Http\Requests\Api\Lead;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;


class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $status = auth()->user()->canCreateLead();
        if (!$status) {
            throw new AuthorizationException('You are not allowed to create more than 5 leads.');
        }

        return $status;
    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
                'name' =>'required',
                'email' => 'required|email|unique:leads,email,NULL,id,user_id,' . auth()->id(),
                'status' => 'required|in:unqualified,qualified,ready to close,won/lost,lost opportunity'
            ];
    }
}
