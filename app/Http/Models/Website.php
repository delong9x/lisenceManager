<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //
    protected $table = 'websites';
    protected $fillable = [
        'domain',
        'email',
        'phone',
        'chat_id',
        'title_open',
        'title_closed',
        'intro_message',
        'auto_response',
        'auto_no_response',
        'placeholder_text',
        'get_customer_info_text',
        'main_color',
        'closed_chat_avatar_url'
        ];
}
