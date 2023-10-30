<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Stringable;
use Illuminate\Support\Traits\EnumeratesValuestoArray;





class actorsviewmodel extends ViewModel
{
    public $populauractors;
    public $page;
    public function __construct($populauractors, $page)
    {
        $this->populauractors = $populauractors;
        $this->page = $page;
    }

   


    public function popualractor()
    {
        return collect($this->populauractors)->map(function ($actor) {
            return collect($actor)->merge([
                // we got a height and width by inspecting them 
                "profile_path" => 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path'],
                // 'profile_path' => [htmlspecialchars('https://image.tmdb.org/t/p/w235_and_h235_face/' . $actor["profile_path"])],
                // "profile_path" => $actor['profile_path']
                //     ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path']
                //     : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],

                'known_for' => implode(', ', collect($actor['known_for'])->pluck('title')->flatten()->all()),
                // 'known_for' => implode(', ', collect($actor['known_for'])->pluck('title')->toArray()),
                // "known_for" => implode(', ', collect($actor['known_for'])->pluck('title')->map('htmlspecialchars')->toArray()),

            ]);
        });
    }



    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}


// ->only('name', 'id', 'profile_path', 'known_for')