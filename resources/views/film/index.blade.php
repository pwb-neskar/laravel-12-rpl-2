@extends('layouts.master')

@push('css')

<link rel="stylesheet" href="{{ asset('/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endpush

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Tahun</th>
                  <th>Genre Film</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($films as $key => $value)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->judul }}</td>
                    <td>{{ $value->tahun }}</td>
                    <td>{{ $value->genre[0]->nama }}</td>
                    <td>
                      <form action="{{ route('film.destroy', $value->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                      <a href="{{ route('film.show', $value->id) }}" class="btn-sm btn-info">Show</a>
                      <a href="{{ route('film.edit', $value->id) }}" class="btn-sm btn-warning">Edit</a>
                        <button type="submit" class="btn-sm btn-danger">Delete</button>
                      </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td>Data Masih Kosong</td>
                    </tr>
                    
                  @endforelse
                
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection

@push('script')
<script src="{{ asset('/template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush