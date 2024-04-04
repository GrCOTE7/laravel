<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
	 * @return array<string, array<mixed>|\Illuminate\Contracts\Validation\ValidationRule|string>
	 */
	public function rules(): array
	{
		return [
			'title'  => 'required|between:3,50',
			'detail' => 'required|between:5,500',
		];
	}
}
