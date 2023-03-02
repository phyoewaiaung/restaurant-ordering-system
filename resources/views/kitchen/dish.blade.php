@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Kitchen Panel</h3>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Dishes</div>
                    <a href="/dish/create" class="btn btn-success float-right">create new dish</a>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table id="dishes" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Dish Name</th>
                            <th>Category Name</th>
                            <th>Created</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dishes as $dish)
                            <tr>
                            <td>{{$dish->name}}</td>
                            <td>{{$dish->category->name}} </td>
                            <td>{{$dish->created_at}}</td>
                            <td>
                                <div class="form-row">
                                    <a style="margin-right:10px" href="/dish/{{$dish->id}}/edit" class="btn btn-warning">Edit</a>
                                    <form action="dish/{{$dish->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                      <button type="submit" onclick="return confirm('Are you sure want to delete?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(function () {
      $('#dishes').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "pageLength":10,
      });
    });
  </script>
@endsection
