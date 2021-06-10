<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','massage','order_id','user_id',
        'ticket_type_id','status',
    ];
  public function ticketType(){

    return $this->belongsTo(TicketType::class);

  }

    public function customer(){

        return $this->belongsTo(User::class,'user_id','id');

    }

    public function order(){

        return $this->belongsTo(Order::class);

    }




}
