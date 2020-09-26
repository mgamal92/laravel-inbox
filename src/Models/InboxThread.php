<?php

namespace MG\Inbox\Models;

use Illuminate\Database\Eloquent\Model;

class InboxThread extends Model
{
    public function messages()
    {
        return $this->hasMany(InboxMessage::class);
    }
}