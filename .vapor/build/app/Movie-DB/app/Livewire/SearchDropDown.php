<?php

namespace App\Livewire;

use app\Livewire\http;

use Livewire\Component;

class SearchDropDown extends Component
{

    public $search = '';



    // protected $rules = [
    //     'search' => 'required|min:3',
    // ];

    public function render()
    {
        $searchresult = [];

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";



        $searchresult = \Illuminate\Support\Facades\Http::withToken($new)
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];

        // dump($searchresult);

        return view('livewire.search-drop-down',[

            'searchresult'=> collect($searchresult)->take(5)

        ]);
    }
}
