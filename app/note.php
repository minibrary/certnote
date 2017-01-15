<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Note extends Model
{
  protected $fillable = ['fqdn', 'port', 'memo', 'daysleft'];
  public  function user()
    {
      return $this->belongsTo(User::class);
    }
}
