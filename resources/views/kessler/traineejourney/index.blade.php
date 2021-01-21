@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trainee Journey</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
           <!--    <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
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
                <h3 class="card-title">Add, View, Edit and Remove Trainee Journey</h3>
              </div>
              <!-- /.card-header -->
              <br>
              <a href="{{ route('traineejourney.create')}}" class="btn btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Trainee Journey</a>

              <div class="card-body">
                <table id="traineejourney" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Trainee ID</th>
                    <th>Session Pin</th>
                    <th>Session Type</th>
                    <th>Session Number</th>
              <!--  <th>Status</th>  -->
                    <th colspan = 2>Actions</th>
                  </tr>
                  </thead>
                 <tbody>
                      @foreach($traineejourney as $traineejourney)
                      <tr>
                         <td>{{$traineejourney->trainee_id}}</td>
                         <td>{{$traineejourney->session_pin}}</td>
                         <td>{{$traineejourney->session_type}}</td>
                         <td>{{$traineejourney->session_number}}</td>
              <!--       <td>
                        <input data-id="{{$traineejourney->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $traineejourney->status ? 'checked' : '' }}>
                         </td> -->
                         <td>
                            <a href="{{ route('traineejourney.edit',$traineejourney->id)}}" class="btn btn-primary far fa-edit"></a>
                          </td>
                          <td>
                              <form action="{{ route('traineejourney.destroy', $traineejourney->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger far fa-trash-alt" type="submit"></button>
                              </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Trainee ID</th>
                    <th>Session Pin</th>
                    <th>Session Type</th>
                    <th>Session Number</th>
              <!--  <th>Status</th> -->
                    <th colspan = 2>Actions</th>
                  </tr>
                  </tfoot>
                </table>
                <!-- SUCCESS -->
                      <div>
                      @if(session()->get('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}  
                        </div>
                      @endif
                    </div>
                <!-- /. SUCCESS -->
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

<script>
  $(function () {
    $('#traineejourney').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>

@endsection