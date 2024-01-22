<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequiest extends FormRequest
{
	public function authorize(): bool
	{
		return auth()->check();
	}

	public function rules(): array
	{
		return [
			'title' => 'required|string|max:100',
			'description' => 'required|string',
			'is_complete' => 'nullable|bool'
		];
	}

	public function messages()
	{
		return [
			'image.max' => 'Maximal length of the \'Title\' is 100 chars.'
		];
	}

	public function prepareForValidation(): void
	{
		if (!$this->get('is_complete')) {
			$this->merge(['is_complete' => false]);
		}
	}
}