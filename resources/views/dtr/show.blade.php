@extends('layouts.app')

@section('content')
   <div class="container">
        <a href="{{ route('dtr.index') }}" class="btn btn-dark btn-sm">
            <i class="fa fa-chevron-left"></i>
            Back
        </a>
       <div>
           <span>Start Date: </span> <strong>{{ $dtr->start_date }}</strong>
       </div>
       <div>
            <span>End Date: </span> <strong>{{ $dtr->end_date }}</strong>
       </div>
       <table class="table table-bordered">
           <thead>
                <tr>
                    <th>
                        Days
                    </th>
                    <th>
                        Time In
                    </th>
                    <th>
                        Time Out
                    </th>
                    <th>
                        OT
                    </th>
                </tr>
           </thead>
           <tbody>
               @for ($i = 0; $i < count($dtr->getArray($dtr->days)); $i++)
                   <tr>
                       <td>
                          {{  $dtr->getArray($dtr->days)[$i] }}
                       </td>
                       <td>
                            {{  $dtr->getArray($dtr->time_in)[$i] }}
                        </td>
                        <td>
                            {{  $dtr->getArray($dtr->time_out)[$i] }}
                        </td>
                        <td>
                            {{  $dtr->getArray($dtr->ot)[$i] }}
                        </td>
                   </tr>
               @endfor
           </tbody>
       </table>
   </div>
@endsection
