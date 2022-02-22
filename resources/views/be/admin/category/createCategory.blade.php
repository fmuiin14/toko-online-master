@extends('layouts.admin-dashboard')

@section('title')
    Crate Category    
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route('category.index') }}" class="btn btn-primary mb-3">Back</a>
        
        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="photo" required>
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
{{-- js here --}}
@endsection