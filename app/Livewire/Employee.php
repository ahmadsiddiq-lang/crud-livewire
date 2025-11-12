<?php

namespace App\Livewire;

use App\Models\Employee as ModelsEmployee;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $nama;
    public $email;
    public $alamat;
    public $updateMode = false;
    public $employeeId;
    
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

    public function edit($id){
        $employee = ModelsEmployee::find($id);
        $this->nama = $employee->nama;
        $this->email = $employee->email;
        $this->alamat = $employee->alamat;
        $this->updateMode = true;
        $this->employeeId = $id;
    }

    public function update(){
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

        $data = ModelsEmployee::find($this->employeeId);
        $data->update($validate);
        session()->flash('message','Data karyawan berhasil diupdate');
        $this->clear();
    }

    public function clear(){
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';
        $this->employeeId = '';
        $this->updateMode = false;
    }

    public function delete($id){
        ModelsEmployee::find($id)->delete();
        session()->flash('message','Data karyawan berhasil dihapus');
        $this->clear();
    }

    public function render()
    {
        $data = ModelsEmployee::orderBy('id','desc')->paginate(2);
        return view('livewire.employee', ['employees'=>$data]);
    }
}
