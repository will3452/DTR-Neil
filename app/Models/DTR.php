<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTotalHoursAttribute(){
        $total = 0;
        $ot = explode('-', $this->ot);
        $time_in = explode('-', $this->time_in);
        $time_out = explode('-', $this->time_out);

        for($i = 0; $i < count($time_in); $i++){
            $total += $ot[$i];
            $ti = explode(':', $time_in[$i]);
            $to = explode(':', $time_out[$i]);
            $tim = end($ti);
            $tih = $ti[0] + ($tim / 60);
            $tom = end($to);
            $toh = $to[0] + ($tom / 60);
            $total += ($tih < 12 && $toh > 12) ? ($toh - $tih) - 1: ($toh - $tih);
        }
        return $total;
    }

    public function getTotalOvertimeAttribute(){
        $total = 0;
        $ots = explode('-', $this->ot);
        foreach($ots as $ot) $total += $ot;
        return $total;
    }

    public function getArray($str){
        return explode('-', $str);
    }
    
}
