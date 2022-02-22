@extends('layouts.admin-dashboard')

@section('title')
    List Product Gallery   
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
        <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">Add Product Gallery</a>
        
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-product-gallery" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Produk</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {
    
    var table = $('.table-product-gallery').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('product-gallery.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            { data: 'product.name', name: 'product.name' },
            { data: 'photos', name: 'photos' },
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });

  // delete confirmation
  function myConfirm() {
  var result = confirm("Want to delete?");
    if (result==true) {
    return true;
    } else {
    return false;
    }
  }
</script>
@endsection