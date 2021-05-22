@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Start/End Date</th>
                <th>Work Days</th>
                <th>Total Overtime</th>
                <th>Total Hours w/ OT</th>
                <th>Date Filed</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dtr as $record)
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
                    <td>
                        <form action="{{ route('dtr.destroy', $record) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('dtr.show', $record) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('dtr.edit', $record) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
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