<?php

namespace SeshSource\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvents extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isBusiness();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:events|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'email',
            'event_logo' => 'image',
            'featured_img' => 'image'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator( $validator )
    {
        if ( $validator->fails() ) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }
}
