<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int id;
 * @property int user_id;
 * @property int application_id;
 * @property string uid;
 * @property string language;
 * @property string operation_system;
 * @property string client_token;
 * @property string|\DateTime created_at;
 * @property string|\DateTime updated_at;
 */
class Device extends Model
{
    use HasFactory;

    public static function fromHeader()
    {
        $token = request()->bearerToken();
        $token = explode('_', $token)[0];
        return Device::where('client_token', $token)->first();
    }
}
