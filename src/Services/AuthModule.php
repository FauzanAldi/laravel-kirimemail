<?php
 
namespace Aldif\LaravelKirimemail\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Aldif\LaravelKirimemail\Services\ListModel;


/**
 * Basic Calculator.
 * 
 */
class AuthModule
{   

    /**
     * Menjumlahkan semua data dalam sebuah array.
     *
     * @param array $data
     * @return integer
     */
    /**
     * @var Repository $config
     */
    protected $baseURLApi;

    protected $checkConnectionLink;

    protected $username;

    protected $apitoken;

    protected $time;
    
    public function __construct()
    {
        $this->baseURLApi = Config::get('kirimemail.baseURLApi','https://api.kirim.email/');
        $this->checkConnectionLink = $this->baseURLApi.Config::get('kirimemail.CheckConnectionURL','v3/list');
        $this->username = Config::get('kirimemail.username','example');
        $this->apitoken = Config::get('kirimemail.apitoken','apitoken');
        $this->time = time();
    }

    public function getGenerateToken()
    {   

        $generated_token = hash_hmac("sha256",$this->username."::".$this->apitoken."::".$this->time,$this->apitoken);

        return $generated_token;
    } 

    public function checkConnection()
    {   

        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->get($this->checkConnectionLink);

        

        if($response->successful()){
            return true;
        }else{
            return false;
        }
        
    }

    public function getAll($category)
    {   

        $data=Config::get('kirimemail.category.'.$category.'.getall');
 
        if(!$data){
            return 'Link Api getAll tidak di temukan';
        }

        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->get($this->baseURLApi.$data);

        return json_decode($response->body());
        
    }

    public function getById($category, $id)
    {   

        $data=Config::get('kirimemail.category.'.$category.'.getbyid');
        
        if(!$data){
            return 'Link Api get by id tidak di temukan';
        }

        $data=str_replace('{id}', $id, $data);

        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->get($this->baseURLApi.$data);

        return json_decode($response->body());
        
    }

    public function delById($category, $id)
    {   

        $data=Config::get('kirimemail.category.'.$category.'.delete');
        
        if(!$data){
            return 'Link Api get by id tidak di temukan';
        }

        $data=str_replace('{id}', $id, $data);
        // dd($data);
        
        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->delete($this->baseURLApi.$data);

        // dd($this->baseURLApi.$data);

        return json_decode($response->body());
        
    }

    public function create($category, $form)
    {   

        $data=Config::get('kirimemail.category.'.$category.'.create');
        
        if(!$data){
            return 'Link Api create tidak di temukan';
        }

        
        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->post($this->baseURLApi.$data, $form);

        // dd($this->baseURLApi.$data);

        return json_decode($response->body());
        
    }

    public function update($category, $id, $form)
    {   

        $data=Config::get('kirimemail.category.'.$category.'.update');
        
        if(!$data){
            return 'Link Api create tidak di temukan';
        }

        $data=str_replace('{id}', $id, $data);

        $response = Http::withHeaders([
            'Auth-Id' => $this->username,
            'Auth-Token' => $this->getGenerateToken(),
            'Timestamp' => $this->time
        ])->put($this->baseURLApi.$data, $form);

        // dd($this->baseURLApi.$data);

        return json_decode($response->body());
        
    }





    
}
 