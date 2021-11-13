@extends('admin')
@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0"> Data Buku</h1>
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
                <div class="card-header">Data Buku</div>
                <div class="card-body">
                   <form action="{{route('book.update',$book->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" name="title" value="{{$book->title}}" class="form-control @error('title') is-invalid @enderror" disabled>
                             @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Penulis Buku</label>
                            <select name="author_id" class="form-control @error('author_id') is-invalid @enderror" disabled>
                                @foreach($author as $data)
                                    <option value="{{$data->id}}" {{$data->id == $book->author_id ? 'selected="selected"' : '' }}>{{$data->name}}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Buku</label>
                            <input type="number" name="amount" value="{{$book->amount}}" class="form-control @error('amount') is-invalid @enderror" disabled>
                             @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Cover Buku</label>
                            <br>
                            <img src="{{ $book->image() }}" height="75" style="padding:10px;" />
                            
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection