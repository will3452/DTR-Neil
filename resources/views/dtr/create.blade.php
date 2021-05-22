@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>
            File A DTR
        </h2>
        <form action="{{ route('dtr.store') }}" method="POST">
            @csrf
            <div class=" form-group" x-data="{
                invalidDate:false,
                timing:null,
                updateDate(){
                    let startDate = this.$refs.start_date.value;
                    let endDate = this.$refs.end_date.value;
                    const a = moment(endDate);
                    const b = moment(startDate);
                    const diff = a.diff(b, 'days');
                    if(startDate != null && endDate != null){
                        this.invalidDate = diff < 5;
                        clearTimeout(this.timing)
                        if(this.invalidDate){
                            this.timing = setTimeout((res)=>{
                                res.value = ''
                            }, 3000, this.$refs.end_date);
                        }
                    }
                },

            }">
               <div class="row">
                    <div class="col">
                        <label for="">Start Date</label>
                        <input type="date" x-ref="start_date" x-on:change="updateDate" name="start_date" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="">End Date</label>
                        <input type="date" x-ref="end_date" x-on:change="updateDate" name="end_date" class="form-control" required>
                        <small class="text-helper text-danger" x-show.transition="invalidDate">Invalid Date</small>
                    </div>
               </div>
            </div>
            <div class="form-group">
                <label for="">
                    Days
                </label>
                @php
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                @endphp
                @foreach ($days as $day)
                    
                    <div class="form-group" x-data="{enable:false}">
                        <div>
                            <input x-on:click="enable =!enable" class="days disabled" type="checkbox" name="days[]" value="{{ $day }}"> {{ $day }}
                        </div>
                        <template x-if="enable">
                            <div class="row" x-data="{
                                timeError:false,
                                errorMessage:'',
                                updateTime(){
                                    let {end_time, start_time} = this.$refs;
                                    if(end_time.value.length != 0 && start_time.value.length != 0){
                                        const startTime = moment(start_time.value, 'HH:mm');
                                        const endTime = moment(end_time.value, 'HH:mm');
                                        let hours = endTime.diff(startTime, 'hours');

                                        if(start_time.value.split(':')[0] < 12 && end_time.value.split(':')[0] > 12 ){
                                            hours--;
                                        }
                                        if(hours < 6){
                                            this.timeError = true;
                                            this.errorMessage = 'Error: minimum of 6-hour working schedule!'
                                        }else {
                                            
                                            if(hours > 8){
                                                let ot = hours - 8;
                                                if(ot > 8){
                                                    this.errorMessage = 'Error: Maximum OT should only be 8-hours!'
                                                    this.timeError = true;
                                                }else {
                                                    this.timeError = false;
                                                    this.$refs.ot.value = ot;
                                                }
                                                
                                            }
                                        }
                                    }
                                }
                            }">
                                <input type="hidden" x-ref="ot" name="ot[]" value="0">
                                <div class="col">
                                    <label for="">Time In</label>
                                    <input  x-on:change="updateTime" x-ref="start_time" type="time" class="form-control" name="time_in[]" required>
                                </div>
                                <div class="col">
                                    <label for="">Time Out</label>
                                    <input x-on:change="updateTime" x-ref="end_time"type="time" class="form-control" name="time_out[]" required>
                                    <small class="help-text text-danger" x-show="timeError">
                                        <div x-text="errorMessage"></div>
                                    </small>
                                </div>
                            </div>
                        </template>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    <i class="fa fa-upload"></i>
                    File Now!
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function(){
            let daysCount = 0;
            const days = document.querySelectorAll('.days');

            for(let day of days){
                day.addEventListener('click', function(e){
                    daysCount = e.target.checked ? ++daysCount:--daysCount;
                    e.target.classList.toggle('disabled');
                    const disabled = document.querySelectorAll('.disabled');
                    if(daysCount == 5){
                        for(let dis of disabled){
                            dis.disabled = true
                        }
                    }else {
                        for(let dis of disabled){
                            dis.disabled = false
                        }
                    }
                })
            }

        }
    </script>
@endpush