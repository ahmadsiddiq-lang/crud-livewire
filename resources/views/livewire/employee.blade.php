<div class="container">
    @if (session()->has('message'))
       <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)" 
        class="alert alert-success"
        >
            {{ session('message') }}
        </div>
    @endif
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" wire:model="nama">
                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label" >Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" wire:model='email'>
                        @error('email')
                             <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label" >Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" wire:model='alamat'>
                        @error('alamat')
                             <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        @if ($updateMode == true)
                            <button type="button" class="btn btn-primary" name="submit" wire:click='update()'>UPDATE</button>
                        @else
                            <button type="button" class="btn btn-primary" name="submit" wire:click='store()'>SIMPAN</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h1>Data Pegawai</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Nama</th>
                        <th class="col-md-3">Email</th>
                        <th class="col-md-2">Alamat</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $item => $value)
                    <tr>
                        <td>{{ $employees->firstItem()+ $item }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" wire:click="edit({{ $value->id }})">Edit</a>
                            <a class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $employees->links() }}
        </div>
        <!-- AKHIR DATA -->
    </div>