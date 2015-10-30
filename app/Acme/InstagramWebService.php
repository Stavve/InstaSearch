<?php
namespace Acme;

use Acme\WebService\InstagramWebServiceInterface;
use Input;

class InstagramWebService implements InstagramWebServiceInterface{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['search'];

    private  $GoogleUrl;
    private  $jsonfile;
    private  $jsonArray;
    private $lat;
    private $lng;
    private $instaUrl;
    private $instafile;
    public $instaArray;




    /**
     * @param $input
     * Kan skrivas om med cURL
     */
    public function getMediaByLocation($input)
    {
        $this->GoogleUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $input . '';
        $this->jsonfile = file_get_contents($this->GoogleUrl);
        $this->jsonArray = json_decode($this->jsonfile, true);

        $this->lat = $this->jsonArray['results'][0]['geometry']['location']['lat'];
        $this->lng = $this->jsonArray['results'][0]['geometry']['location']['lng'];

        $this->instaUrl = 'https://api.instagram.com/v1/media/search?lat='.$this->lat.'&lng='.$this->lng.'&access_token='.env('ACCESS_TOKEN').'';
        $this->instafile = file_get_contents($this->instaUrl);
        $this->instaArray = json_decode($this->instafile,true);

        return $this->instaArray;
    }

    /**
     * @return JsonArray
     */
    public function getMostPopularMedia(){
        $ch = curl_init();
        curl_setopt_array($ch,array(
            CURLOPT_URL => 'https://api.instagram.com/v1/media/popular?access_token='.env('ACCESS_TOKEN').'',
            CURLOPT_RETURNTRANSFER => TRUE,
        ));

        $request_data = curl_exec($ch);
        curl_close($ch);

        return json_decode($request_data,true);
    }


    /**
     * @param $input
     * @return JsonArray
     */
    public function getMediaByTag($input){
        $ch = curl_init();
        curl_setopt_array($ch,array(
            CURLOPT_URL => 'https://api.instagram.com/v1/tags/'.$input.'/media/recent?access_token='.env('ACCESS_TOKEN').'&count=60',
            CURLOPT_RETURNTRANSFER => TRUE
        ));

        $data = curl_exec($ch);
        curl_close($ch);

        return json_decode($data,true);
    }

}