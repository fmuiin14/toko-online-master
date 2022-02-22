@extends('layouts.admin-dashboard')

@section('title')
    Crate Product    
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
        
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Nama Product</label>
            <input type="text" class="form-control" name="name" required value="">
          </div>
          <div class="form-group">
            <label>Pemilik Product</label>
            <select name="users_id" class="form-control">
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Kategori Product</label>
            <select name="categories_id" class="form-control">
              @foreach ($categories as $categories)
                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="price" required value="">
          </div>
          <div class="form-group">
            <label>Cover</label>
            <input type="file" class="form-control" name="cover" required value="">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" id="editor"></textarea>
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