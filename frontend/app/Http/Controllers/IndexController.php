<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class IndexController extends Controller
{

    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('API_URL'),
            'timeout'  => 2.0,
        ]);
    }
 
    public function index(){

        $response = $this->client->request('GET', '/api/v1/products');
        $response = json_decode($response->getBody(),true);
        $products = $response['data'];
        return view('index')->with('products',$products);
    }

    public function create(Request $request){

        $payload = [
            'name' => $request->name,
            'price' => $request->price,
        ];

        $response = $this->client->request('POST', '/api/v1/products',
        ['json' => $payload]);
        $response = json_decode($response->getBody(),true);
        if($response['status'] == 'success'){
            return redirect('/');
        }
    }


    public function update(Request $request){

        $payload = [
            'name' => $request->edit_name,
            'price' => $request->edit_price,
        ];
        $product_id = $request->product_id;
        $response = $this->client->request('PUT', "/api/v1/products/{$product_id}",
        ['json' => $payload]);
        $response = json_decode($response->getBody(),true);
        if($response['status'] == 'success'){
            return redirect('/');
        }
    }


    public function delete(Request $request){

        $product_id = $request->product_id;
        $response = $this->client->request('DELETE', "/api/v1/products/{$product_id}",
        ['json' => []]);
        $response = json_decode($response->getBody(),true);
        if($response['status'] == 'success'){
            return redirect('/');
        }
    }
}
