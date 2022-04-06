<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Form;
use Laravel\Socialite\Facades\Socialite;

class GeneralTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_form()
    {
        $this->withoutExceptionHandling();
        $temp = $this->get('api/angular/countforms');
        $response = $this->post('/api/forms', [
            'name' => 'Formulari test',
            'description' => 'Formulari test'
        ]);
        $temp2 = $this->get('api/angular/countforms');
        $this->assertFalse($temp2 > $temp);
    }
    public function test_socialite_provider_incorrecte()
    {
        $this->get('/accedir/test')
        ->assertRedirect('/accedir');
    }

    public function test_socialite_provider_correcte()
    {
        $this->get('/accedir/google')
        ->assertSee("google");
    }
    public function test_middleware()
    {
        $this->get('/formulari/crear')
        ->assertRedirect('/accedir');
    }

}
