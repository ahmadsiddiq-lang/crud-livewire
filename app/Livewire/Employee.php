<?php

namespace App\Livewire;

use App\Models\Employee as ModelsEmployee;
use Livewire\Component;

class Employee extends Component
{
    public $nama;
    public $email;
    public $alamat;

    public function store (){
       
        $validate = $this->validate(
            [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            ],
            [
                'nama.required'=>'Nama wajib diisi',
                'email.required'=>'Email wajib diisi',
                'email.email'=>'Format email tidak valid',
                'alamat.required'=>'Alamat wajib diisi',
            ]
        );
        
        ModelsEmployee::create($validate);
        session()->flash('message','Data karyawan berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.employee');
    }
}
