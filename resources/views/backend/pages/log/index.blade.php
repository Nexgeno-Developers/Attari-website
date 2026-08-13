@extends('backend.layouts.app') 

@section('page.name', 'Logs')

@section('page.content')
<div class="card">
   <div class="card-body">
      <div class="row mb-2">
         <div class="col-sm-5">
            <h3>List</h3>
         </div>
         <!-- end col-->
      </div>
      <div class="table-responsive">
      <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Remark</th>
                <th>Date</th>

            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($log as $row)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$row->remark}}</td>
                <td>{{$row->created_at}}</td>
            </tr>
            @endforeach
    </table>
      </div>
   </div>
   <!-- end card-body-->
</div>
@endsection

@section("page.scripts")
<script>
    var responseHandler = function(response) {
        location.reload();
    }
</script>
@endsection