<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'invoice_date' => ['nullable', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.service_type' => ['required', 'string', 'in:tiket_pesawat,hotel,sewa_mobil,taksi,lainnya'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.original_price' => ['nullable', 'numeric', 'min:0'],
            'items.*.notes' => ['nullable', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];

        // Dynamic validation based on service type
        if ($this->has('items')) {
            foreach ($this->input('items', []) as $index => $item) {
                $serviceType = $item['service_type'] ?? null;

                switch ($serviceType) {
                    case 'tiket_pesawat':
                        $rules["items.{$index}.maskapai"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.rute"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.nomor_tiket"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.nomor_penerbangan"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.tanggal_keberangkatan"] = ['required', 'date'];
                        $rules["items.{$index}.jumlah_penumpang"] = ['required', 'integer', 'min:1'];
                        break;

            case 'hotel':
                $rules["items.{$index}.nama_hotel"] = ['required', 'string', 'max:255'];
                $rules["items.{$index}.kota"] = ['required', 'string', 'max:255'];
                $rules["items.{$index}.check_in"] = ['required', 'date'];
                $rules["items.{$index}.check_out"] = ['required', 'date', "after:items.{$index}.check_in"];
                $rules["items.{$index}.jumlah_kamar"] = ['required', 'integer', 'min:1'];
                $rules["items.{$index}.harga_per_malam"] = ['required', 'numeric', 'min:0'];
                break;

                    case 'sewa_mobil':
                        $rules["items.{$index}.jenis_mobil"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.durasi_sewa"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.dengan_sopir"] = ['nullable', 'boolean'];
                        break;

                    case 'taksi':
                        $rules["items.{$index}.rute_perjalanan"] = ['required', 'string', 'max:255'];
                        $rules["items.{$index}.tanggal"] = ['required', 'date'];
                        break;

                    case 'lainnya':
                        $rules["items.{$index}.deskripsi"] = ['required', 'string', 'max:1000'];
                        break;
                }
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'customer_phone.required' => 'Nomor telepon/WhatsApp wajib diisi.',
            'customer_email.email' => 'Format email tidak valid.',
            'services.required' => 'Pilih minimal satu jenis layanan.',
            'services.min' => 'Pilih minimal satu jenis layanan.',
            'items.required' => 'Detail layanan wajib diisi.',
            'items.min' => 'Detail layanan wajib diisi.',
            'items.*.service_type.required' => 'Jenis layanan wajib dipilih.',
            'items.*.price.required' => 'Harga wajib diisi.',
            'items.*.price.numeric' => 'Harga harus berupa angka.',
            'items.*.price.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
