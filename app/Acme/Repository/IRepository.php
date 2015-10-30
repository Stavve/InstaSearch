<?php
/**
 * Created by PhpStorm.
 * User: Stavros1
 * Date: 15-08-17
 * Time: 23:39
 */

namespace Acme\Repository;

interface IRepository{


   //Used for Photos
    public function saveLocationPhotos($json);
    public function getAllLocationPhotos($input);
    public function ifCityExists($input);
    public function refreshLocationPhotos();

    //Used for Tags
    public function saveTagPhotos($json);
    public function getAllTagPhotos($input);
    public function ifTagExists($input);
    public function refreshTagPhotos();




}