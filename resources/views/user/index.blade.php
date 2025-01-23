<x-app-layout :title="$title">
    <div class="section">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('user.update') }}" method="post">
                    @csrf
                    <table class="table table-stripped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
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

</x-app-layout>