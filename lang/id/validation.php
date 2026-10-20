<?php

return [

    /* Terjemahan pesan validasi yang dipakai form publik.
       Key lain otomatis fallback ke terjemahan bawaan framework (EN). */

    'required' => ':attribute wajib diisi.',
    'required_if' => ':attribute wajib diisi ketika :other bernilai :value.',
    'required_unless' => ':attribute wajib diisi kecuali :other berada di antara nilai :values.',
    'required_with' => ':attribute wajib diisi ketika :values ada.',
    'required_without' => ':attribute wajib diisi ketika :values tidak ada.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'string' => ':attribute harus berupa teks.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'numeric' => ':attribute harus berupa angka.',
    'url' => ':attribute harus berupa URL yang valid.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'same' => ':attribute dan :other harus sama.',
    'unique' => ':attribute sudah pernah dipakai.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'in' => ':attribute yang dipilih tidak valid.',
    'between' => [
        'numeric' => ':attribute harus di antara :min dan :max.',
        'file' => ':attribute harus di antara :min dan :max kilobyte.',
        'string' => ':attribute harus di antara :min dan :max karakter.',
        'array' => ':attribute harus memiliki :min sampai :max item.',
    ],
    'min' => [
        'numeric' => ':attribute minimal :min.',
        'file' => ':attribute minimal :min kilobyte.',
        'string' => ':attribute minimal :min karakter.',
        'array' => ':attribute minimal memiliki :min item.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal :max.',
        'file' => ':attribute maksimal :max kilobyte.',
        'string' => ':attribute maksimal :max karakter.',
        'array' => ':attribute maksimal memiliki :max item.',
    ],

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'subject' => 'subjek',
        'message' => 'pesan',
        'password' => 'kata sandi',
    ],

];
