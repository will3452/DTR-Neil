@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>
                    ID no.
                </th>
                <th>
                    Name
                </th>
                <th>
                    Username
                </th>
                <th>
                    Gender
                </th>
                <th>
                    Status
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->id_number }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->gender }}
                    </td>
                    <td>
                        {{ $user->status }}
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('admin-accounts.show', $user) }}" class="btn btn-success btn-sm mx-1">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="{{ route('admin-accounts.destroy', $user) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm mx-1">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin-messages.show', $user) }}" class="btn btn-dark btn-sm">
                            <i class="fa fa-envelope"></i>
                        </a>
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