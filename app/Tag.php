<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use Carbon\Carbon;

class Tag extends Model {

    protected $table = 'PhotoByTag';
    protected $fillable = ['tag','photoId','username','likes'];

}
