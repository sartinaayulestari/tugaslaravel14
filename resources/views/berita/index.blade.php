@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Berita</div>                
                <div class="card-body">
                <a href="{!! route('berita.create') !!}" class="btn btn-primary">Tambahkan Data</a>
                <table class="table table-bordered table-primary">
                    <tr class="table table-bordered table-dark">
                        <td>ID</td>
                        <td>Judul</td>
                        <td>Isi</td>
                        <td>Users Id</td>
                        <td>Kategori Id</td>
                        <td>Create</td>
                        <td>Update</td>
                        <td>Aksi</td>
                    </tr>

                    @foreach ($listBerita as $item)

                    <tr>
                        <td>{!! $item->id !!}</td>
                        <td>{!! $item->judul !!}</td>
                        <td>{!! $item->isi !!}</td>
                        <td>{!! $item->users_id !!}</td>
                        <td>{!! $item->kategori_berita_id !!}</td>
                        <td>{!! $item->created_at->format('d/m/Y H:i') !!}</td>
                        <td>{!! $item->updated_at->format('d/m/Y H:i') !!}</td>
                        <td>
                            <a href="{!! route('berita.show' ,[$item->id]) !!}"  
                                class="btn btn-sm btn-success">Lihat</a>
                                <a href="{!! route('berita.edit' ,[$item->id]) !!}"  
                                class="btn btn-sm btn-warning">Ubah</a>
                                {!! Form::open(['route' => ['berita.destroy', $item->id], 'method'=>'delete']) !!}
                                
                                {!! Form::submit('Hapus',['class'=>'btn btn-sm btn-danger','onclick'=>"return confirm('Apakah Anda Yakin Menghapus Data Ini?')"]) !!}
                                
                                {!! Form::close() !!}
                    </tr>

                        @endforeach

                </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
