@extends('admin')

@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Data Buku</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Buku
                    <a href="{{route('book.create')}}" class="btn btn-sm btn-outline-primary float-right">Tambah Buku</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Nomor</th>
                                <th>Judul Buku</th>
                                <th>Nama Penulis</th>
                                <th>Jumlah Buku</th>
                                <th>Cover Buku</th>
                                <th>Aksi</th>
                            </tr>
                            @php $no=1; @endphp
                            @foreach($books as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->title}}</td>
                                <td>{{$data->author->name}}</td>
                                <td>{{$data->amount}}</td>
                                <td><img src="{{$data->image()}}" alt="" style="width:150px; height:150px;" alt="Cover"></td>
                                <td>
                                    <form action="{{route('book.destroy',$data->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="{{route('book.edit',$data->id)}}" class="btn btn-outline-info">Edit</a>
                                        <a href="{{route('book.show',$data->id)}}" class="btn btn-outline-warning">Show</a>
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('apakah anda yakin menghapus ini?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection