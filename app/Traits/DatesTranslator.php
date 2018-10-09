<?php
namespace App\Traits;

use Jenssegers\Date\Date;

trait DatesTranslator
{
    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }
    public function getStartDateAttribute($date_start)
    {
        return new Date($date_start);
    }
    public function getDateEndAttribute($date_end)
    {
        return new Date($date_end);
    }
    public function getUpdateAtAttribute($update_at)
    {
        return new Date($update_at);
    }
}