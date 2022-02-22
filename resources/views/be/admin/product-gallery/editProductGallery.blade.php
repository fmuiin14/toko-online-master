@extends('layouts.admin-dashboard')

@section('title')
    Edit Product Gallery    
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Gallery</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route('product-gallery.index') }}" class="btn btn-primary mb-3">Back</a>
        
        <form action="{{ route('product-gallery.update', $item->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
              <label>Product</label>
              <select name="products_id" class="form-control">
                @foreach ($products as $product)
                  <option @if ($item->products_id == $product->id)
                    selected
                    @endif value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
          </div>

          <div class="form-group">
            <label>Foto</label><br>
            <img src="{{ asset('storage') .'/'. $item->photos }}" class="img-fluid" style="max-width: 150px;" alt="foto lama">
            <small>(foto sebelumnya)</small>

            <br><br>
            <input type="file" class="form-control" name="photos" placeholder="Photo" />
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