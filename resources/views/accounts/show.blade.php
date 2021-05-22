@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('admin-accounts.index') }}" class="btn btn-dark btn-sm">
        <i class="fa fa-chevron-left"></i>
        Back
    </a>
    <h2 class="text-center text-uppercase">
        DTR OF {{ $user->name }}
    </h2>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Start/End Date</th>
                <th>Work Days</th>
                <th>Total Overtime</th>
                <th>Total Hours w/ OT</th>
                <th>Date Filed</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($user->dtrs()->get() as $record)
                <tr>
                    <td>
                        {{ $record->start_date }} - {{ $record->end_date }}
                    </td>
                    <td>
                        {{ implode(', ', explode('-', $record->days)) }}
                    </td>
                    <td>
                        {{ $record->total_overtime }}
                    </td>
                    <td>
                        {{ $record->total_hours }}
                    </td>
                    <td>
                        {{ $record->created_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


@push('scripts')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
    <script src="/js/jq.js" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endpush