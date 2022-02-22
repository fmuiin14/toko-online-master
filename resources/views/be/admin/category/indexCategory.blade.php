@extends('layouts.admin-dashboard')

@section('title')
    Store Category    
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
        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add Category</a>
        
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-category" width="100%">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Foto</th>
              <th scope="col">Slug</th>
              <th scope="col">Aksi</th>
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
    
    var table = $('.table-category').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: "{{ route('category.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'photo', name: 'photo'},
            {data: 'slug', name: 'slug'},
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