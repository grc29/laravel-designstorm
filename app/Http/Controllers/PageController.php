<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Project;
    
class PageController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages/home', compact('user'));
    }

    public function results(Request $request) {
        $search = $request->search;
        return redirect('search/'.urlencode($search));
    }
    
    public function search(Request $request, $keyword) {
        $api_key = env("BEHANCE_KEY");
        $field = "Web Design";

        $client = new Client();
        $res = $client->request('GET', "https://api.behance.net/v2/projects", [
            'query' => [
                'q' => $keyword,
                'client_id' => $api_key,
                'field' => $field
            ]
        ]);

        $data = $res->getBody();
        $data = json_decode($data);
        $filteredData = $data->projects;

        $inspirationArray = Project::where('user_id', Auth::id())->first();
        $inspirationArray = $inspirationArray->inspirations;
        $imageInfoArray = [];

        foreach($inspirationArray as $image) {
            array_push($imageInfoArray, $image->image_info);
        }

        $user = Auth::user();
        return view('pages/results', compact('user','filteredData','keyword','imageInfoArray'));
    }
}
