@section('title', 'Jurnal Pembelajaran PKL')
<div>
    @if ($cek_siswa == 0)
        <div class="alert alert-warning">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
            Anda belum memiliki siswa bimbingan pkl, harap lakukan setting pada halaman berikut.<br>
            <a href="{{route('siswa-pkl')}}"><button class="btn btn-sm btn-secondary">Setting Siswa PKL</button></a>
        </div>
    @else
        Ini yang lain
    @endif
</div>
