<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
    public $fillable = ['pseudo', 'password', 'mail'];

}
