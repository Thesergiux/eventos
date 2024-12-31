<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $appends = ['formated_start_date', 'formated_finish_date'];

    /**
     * Return the slugified name of the section.
     *
     * @return string
     */
    public function getFormatedStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->translatedFormat('d \d\e F \d\e Y');
    }
    /**
     * Return the slugified name of the section.
     *
     * @return string
     */
    public function getFormatedFinishDateAttribute()
    {
        return Carbon::parse($this->finish_date)->translatedFormat('d \d\e F \d\e Y');
    }
}
