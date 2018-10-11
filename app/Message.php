<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function senders()
    {
    	return $this->hasOne('\ReclutaTI\User', 'id', 'sender');
    }
}
