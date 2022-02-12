<?php
 
namespace Aldif\LaravelKirimemail\Services;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
 
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
        $this->checkConnectionLink = Config::get('kirimemail.baseURLApi',$this->baseURLApi.'v3/list');
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



    
}
 