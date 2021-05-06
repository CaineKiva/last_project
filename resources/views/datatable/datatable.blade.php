
@extends('layouts.master')

@section('content')
  
   <br>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Date</th>
                <th>Address</th>
                <th>Phone</th>  
                <th>Gender</th>
                <th>Email</th>
                    
            </tr>
        </thead>
    </table>
@endsection

@push('js')
<script>
jQuery(document).ready(function($) {
    $('#users-table').dataTable({
        processing: true,
        serverSide: true,
        ajax: '{{  route('students.view_all') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'date', name: 'date' },
            { data: 'address', name: 'address' },
            { data: 'phone', name: 'phone' },
            { data: 'gender', name: 'gender' },
            { data: 'email', name: 'email' },

        ]
    });
});
</script>
@endpush