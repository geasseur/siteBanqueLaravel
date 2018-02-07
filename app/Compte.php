<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    public $timestamps = false;
    protected $fillable = ['idUser','type_account','owner','credit'];
}
