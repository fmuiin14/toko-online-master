@extends('layouts.admin-dashboard')

@section('title')
    Edit Category    
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
        
        <form action="{{ route('category.update', $item->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="name" required value="{{ $item->name }}">
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="photo">
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