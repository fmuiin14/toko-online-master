@extends('layouts.admin-dashboard')

@section('title')
    List Product    
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
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add Product</a>
        
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-product" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Cover</th>
              <th>Pemilik</th>
              <th>Kategori</th>
              <th>Harga</th>
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
    
    var table = $('.table-product').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('product.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'name', name: 'name' },
            { data: 'cover', name: 'cover' },
            { data: 'user.name', name: 'user.name' },
            { data: 'category.name', name: 'category.name' },
            { data: 'price', name: 'price' },
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