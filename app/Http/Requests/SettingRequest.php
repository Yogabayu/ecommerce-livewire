<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_app' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'main_tlp' => 'required|string|max:20',
            'ig' => 'required|string|max:255',
            'fb' => 'required|string|max:255',
            'wa' => 'required|string|max:20',
            'version' => 'required|string|max:20',
            'desc' => 'required|string',
            'logo' => 'mimes:jpeg,jpg,png|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name_app.required' => 'Nama aplikasi wajib diisi.',
    //         'address.required' => 'Alamat wajib diisi.',
    //         'email.required' => 'Email wajib diisi.',
    //         'email.email' => 'Format email tidak valid.',
    //         'main_tlp.required' => 'Nomor telepon utama wajib diisi.',
    //         'ig.required' => 'Akun Instagram wajib diisi.',
    //         'fb.required' => 'Akun Facebook wajib diisi.',
    //         'wa.required' => 'Nomor WhatsApp wajib diisi.',
    //         'version.required' => 'Versi aplikasi wajib diisi.',
    //         'desc.required' => 'Deskripsi wajib diisi.',
    //         'logo.image' => 'File yang diunggah harus berupa gambar.',
    //         'logo.mimes' => 'Format file logo harus jpeg, jpg, atau png.',
    //         'logo.max' => 'Ukuran file logo tidak boleh lebih dari 2 MB.',
    //     ];
    // }
}
