<?php
/**
 * Created by PhpStorm.
 * User: Stavros1
 * Date: 15-08-18
 * Time: 19:57
 */

namespace Acme\Repository;
use App\Tag;
use App\Photos;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Cache;
use DB;


class PhotoRepository implements IRepository
{

    public function saveTagPhotos($json){

        foreach($json['data'] as $data){

            $post = Tag::create([
                'tag' 		=> Input::get('tag'),
                'photoId' 	=> $data['images']['standard_resolution']['url'],
                'username' 	=> $data['user']['username'],
                'likes' 	=> $data['likes']['count']
            ]);
        }
    }


    public function getAllTagPhotos($input){

        /*
         * Caching the query with the users input 1 hour
         */
        $cached =  Cache::remember($input, 60, function() use ($input) {
            return Tag::where('tag', '=', $input)->get();
        });

        return $cached;
    }


    public function ifTagExists($input){

        return Tag::where('tag','=',$input)->exists();
    }



    public function refreshTagPhotos(){

        $time = Carbon::now()->subHour(1);
        $tags = Tag::where('tag','=',Input::get('tag'))->where('created_at','<=',$time)->delete();

        return $tags;
    }


    public function saveLocationPhotos($json){

        foreach($json['data'] as $data){

            $post = Photos::create([
                'city' 		=> Input::get('search'),
                'photoId' 	=> $data['images']['standard_resolution']['url'],
                'username' 	=> $data['user']['username'],
                'likes' 	=> $data['likes']['count']
            ]);
        }
    }


    public function getAllLocationPhotos($input){

        /*
         * Caching the query with the users input for 1 hour
         */
        $cached = Cache::remember($input,60,function() use ($input){

            return Photos::where('city','=',$input)->get();
        });

        return $cached;
    }


    public function ifCityExists($input){

        return Photos::where('city','=',$input)->exists();
    }



    public function refreshLocationPhotos(){

        $time = Carbon::now()->subHour(1);
        $photos = Photos::where('city','=',Input::get('search'))->where('created_at','<=',$time)->delete();

        return $photos;
    }

}