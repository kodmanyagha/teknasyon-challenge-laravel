<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int id;
 * @property string name;
 * @property string description;
 * @property string|\DateTime created_at;
 * @property string|\DateTime updated_at;
 */
class Application extends Model
{
    use HasFactory;
}
