<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use Carbon\Carbon;


class Photos extends Model {

	protected $table = 'PhotosByLocation';
	protected $fillable = ['city','photoId','username','likes'];
}
