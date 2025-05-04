<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Измените на true или добавьте свою логику авторизации
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'user_id' => 'required|exists:users,id'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок поста обязателен',
            'title.max' => 'Заголовок не должен превышать 255 символов',
            'content.required' => 'Содержание поста обязательно',
            'image.image' => 'Файл должен быть изображением',
            'image.mimes' => 'Допустимые форматы изображений: jpeg, png, jpg, webp',
            'image.max' => 'Максимальный размер изображения 2MB',
            'user_id.required' => 'Необходимо указать автора',
            'user_id.exists' => 'Указанный автор не существует'
        ];
    }
}