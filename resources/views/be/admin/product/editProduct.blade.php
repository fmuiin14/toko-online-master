@extends('layouts.admin-dashboard')

@section('title')
    Edit Product    
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route('product.index') }}" class="btn btn-primary mb-3">Back</a>
        
        <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label>Nama Product</label>
            <input type="text" class="form-control" name="name" required value="{{ $item->name }}">
          </div>
          <div class="form-group">
            <label>Pemilik Product</label>
            <select name="users_id" class="form-control">
                @foreach ($users as $user)
                  <option @if ($item->users_id == $user->id)
                    selected
                    @endif value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Kategori Product</label>
              <select name="categories_id" class="form-control">
                  @foreach ($categories as $categories)
                    <option @if ($item->categories_id == $categories->id)
                      selected
                      @endif value="{{ $categories->id }}">{{ $categories->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="price" value="{{ $item->price }}" required />
          </div>

          <div class="form-group">
            <label>Foto</label><br>
            <img src="{{ asset('storage') .'/'. $item->cover }}" class="img-fluid" style="max-width: 150px;" alt="foto lama">
            <small>(foto sebelumnya)</small>

            <br><br>
            <input type="file" class="form-control" name="cover" placeholder="Photo" />
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" id="editor">{!! $item->description !!}</textarea>
          </div>
          

          <br>
          <br>

          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
@endsection