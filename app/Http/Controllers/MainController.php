<?php namespace App\Http\Controllers;


use Acme\Repository\IRepository;
use Acme\WebService\InstagramWebServiceInterface;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Validator;
use Input;
use DB;



class MainController extends Controller {

    private $webService;
    private $repository;


    
    public function __construct(IRepository $IRepository,InstagramWebServiceInterface $IWebservice){

        $this->webService = $IWebservice;
        $this->repository = $IRepository;
    }


    public function photos(){
        return view('photos');
    }

    public function index()
    {
        return view('index');
    }


    public function tags(){
        return view('tags');
    }

    public function video(){
        return view('video');
    }

    public function test(){
        return view('test');
    }


    /**
     * @param IRepository $repository
     * @return JSON response
     */
    protected function apiJsonResponse(){
        try{
            $jsonData = $this->webService->getMostPopularMedia();
            return response()->json($jsonData);
        }catch(\Exception $ex){
            return $ex->getCode();
        }
    }


    /**
     * @param Request $request
     * @return View
     */
    public function getPhotoByTag(Request $request){

        $input = ['tag' => $request->get('tag')];
        $rules = ['tag' => 'required'];
        $validator = Validator::make($input, $rules);

        try{
            if($validator->fails()){
                return view('tags')->withErrors($validator);
            }else{
                if(!$this->repository->ifTagExists($input)){

                    $jsonData = $this->webService->getMediaByTag(str_replace(' ','',$input['tag']));
                    $this->repository->saveTagPhotos($jsonData);
                    $dbPhotos = $this->repository->getAllTagPhotos($input['tag']);

                    return view('tags',compact('dbPhotos'));

                }elseif($this->repository->ifTagExists($input)){

                    if($this->repository->refreshTagPhotos()){
                        $jsonData = $this->webService->getMediaByTag($input['tag']);
                        $this->repository->saveTagPhotos($jsonData);
                    }
                    DB::connection()->enableQueryLog();

                    $dbPhotos = $this->repository->getAllTagPhotos($input['tag']);

                    $test = DB::getQueryLog();

                    print_r($test);
                    return view('tags',compact('dbPhotos'));
                }
            }
        }catch (Exception $ex){
            return $ex->getCode();
        }
    }


    /**
     * @param Request $request
     * @return View
     */
    public function getPhotosByLocation(Request $request){

        $input = ['search' => $request->get('search')];
        $rules = ['search' => 'required'];
        $validator = Validator::make($input, $rules);

        try {
            if($validator->fails()){
                return view('index')->withErrors($validator);
            }else{
                if(!$this->repository->ifCityExists($input)){

                    $jsonData = $this->webService->getMediaByLocation(str_replace(' ','',$input['search']));
                    $this->repository->saveLocationPhotos($jsonData);
                    $dbPhotos = $this->repository->getAllLocationPhotos($input['search']);

                    return view('index',compact('dbPhotos'));

                }elseif($this->repository->ifCityExists($input)){

                    if($this->repository->refreshLocationPhotos()){
                        $jsonData = $this->webService->getMediaByLocation($input['search']);
                        $this->repository->saveLocationPhotos($jsonData);
                    }
                    DB::connection()->enableQueryLog();

                    $dbPhotos = $this->repository->getAllLocationPhotos($input['search']);

                    $test = DB::getQueryLog();

                    print_r($test);
                    return view('index',compact('dbPhotos'));
                }
            }
        }catch (Exception $ex){
            return $ex->getCode();
        }
    }
}
