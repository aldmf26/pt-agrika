<x-app-layout :title="$title">
    <div class="section">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="row g-3" id="form">

                        <div class="col-md-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <form action="{{ route('user.update') }}" method="post">
                    @csrf
                    <table class="table table-dark table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Ttd</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr x-data="{
                                    edit: false
                                }">
                                    <td>

                                        {{ $loop->iteration }}
                                        <input type="hidden" name="id[]" value="{{ $user->id }}">
                                    </td>

                                    <td>
                                        <span x-show="!edit">{{ $user->name }}</span>
                                        <input type="text" x-show="edit" value="{{ $user->name }}"
                                            class="form-control" name="name[]">
                                    </td>

                                    <td>
                                        <span x-show="!edit">{{ $user->email }}</span>
                                        <input type="text" x-show="edit" value="{{ $user->email }}"
                                            class="form-control" name="email[]">
                                    </td>

                                    <td>
                                        @if ($user->roles->isNotEmpty())
                                            <span x-show="!edit">{{ $user->roles->first()->name }}</span>
                                        @else
                                            <span x-show="!edit">-</span>
                                        @endif
                                        <select name="role[]" id="" x-show="edit" class="form-control">
                                            <option value="">- Pilih role -</option>
                                            @foreach ($roles as $r)
                                                <option @selected(isset($user->roles[0]) && $user->roles[0]->id == $r->id) value="{{ $r->id }}">
                                                    {{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @if (empty($user->ttd))
                                            <button data-id="{{ $user->id }}" class="btn btn-xs btn-info uploadttd"
                                                type="button">Upload
                                                ttd</button>
                                        @else
                                            <img src="{{ Storage::url($user->ttd->link) }}" width="250"
                                                alt="">
                                        @endif
                                        <img src="" alt="">
                                    </td>
                                    <td>
                                        <a x-show="!edit" @click="edit = !edit" class="btn btn-sm btn-primary"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <a x-show="edit" @click="edit = !edit" class="btn btn-sm btn-primary">
                                            Cancel</a>
                                        <button type="submit" x-show="edit" class="btn btn-sm btn-success"><i
                                                class="fa fa-check"></i>
                                            Simpan</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </form>
            </div>
        </div>

    </div>

    <form action="{{ route('user.upload') }}" enctype="multipart/form-data" method="post">
        @csrf
        <x-modal idModal="uploadttd">

        </x-modal>
    </form>

    @section('scripts')
        <script>
            $('.uploadttd').click(function() {
                let id = $(this).data('id');
                $('#uploadttd').modal('show');
                $('#uploadttd .modal-body').html(`
                    <input type="hidden" name="id" value="${id}">
                    <div class="form-group">
                        <label for="">Upload TTD</label>
                        <input type="file" name="ttd" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Preview</label>
                        <img src="" alt="" class="img-preview" width="200" height="100">
                    </div>
                `);
                $('#uploadttd').on('shown.bs.modal', function() {
                    $(this).find('input[name="ttd"]').focus();
                });
                $('#uploadttd').on('hidden.bs.modal', function() {
                    $(this).find('input[name="ttd"]').val('');
                    $(this).find('.img-preview').attr('src', '');
                });
                $('#uploadttd').on('change', 'input[name="ttd"]', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $('#uploadttd .img-preview').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
