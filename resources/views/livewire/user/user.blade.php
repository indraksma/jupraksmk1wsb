@section('title', 'User')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data User</h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Identity</th>
                    <th>Email</th>
                    <th style="width: 80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $users)
                <tr>
                    <td>{{$users->name}}</td>
                    <td>{{$users->nip}}</td>
                    <td>{{$users->identity}}</td>
                    <td>{{$users->email}}</td>
                    <td><span class="badge bg-danger">55%</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-sm-12 col-md-12"><div class="dataTables_paginate paging_simple_numbers">
            {{ $user->links() }}
        </div></div>
    </div>

</div>
