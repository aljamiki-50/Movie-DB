<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use GuzzleHttp\Psr7\Response;
use Symfony\Component\Console\Tester\Constraint\CommandIsSuccessful;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{

    public function test_movies(){

        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Popualr Movies');
    }
   
}
