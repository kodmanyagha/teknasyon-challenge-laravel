<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int id;
 * @property int user_id;
 * @property int application_id;
 * @property string operation_system;
 * @property string receipt;
 * @property string status;
 * @property string|\DateTime expire_date;
 * @property string|\DateTime created_at;
 * @property string|\DateTime updated_at;
 */
class Subscription extends Model
{
    use HasFactory;

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
