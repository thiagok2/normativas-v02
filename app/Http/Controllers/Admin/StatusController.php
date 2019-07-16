<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;

class StatusController extends Controller
{
    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    public function __construct(){

        $hosts = [        
            getenv('ELASTIC_URL')
        ];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function index(){

        $health = $this->client->cat()->health();
        $nodes = $this->client->cat()->nodes();
        $indices = $this->client->cat()->indices();
        $allocation = $this->client->cat()->allocation();
        $shards = $this->client->cat()->shards();                

        return view('admin.status', compact('health','nodes','indices','allocation','shards'));
    }
}
