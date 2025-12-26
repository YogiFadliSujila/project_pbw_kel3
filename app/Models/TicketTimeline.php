<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTimeline extends Model
{
    protected $fillable = ['transaction_id', 'title', 'description', 'status_type'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
