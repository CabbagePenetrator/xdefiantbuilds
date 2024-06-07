<?php

use App\Models\Gun;
use App\Models\Loadout;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

test('all loadouts can be viewed', function () {
    $loadouts = Loadout::factory()->count(3)->create();

    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Loadouts/Index')
            ->has('loadouts', 3, fn (Assert $page) => $page
                ->where('name', $loadouts->first()->name)
                ->etc()
            )
        );
});

test('a loadout can be created', function () {
    $gun = Gun::factory()->create();

    post('/loadouts', [
        'gun_id' => $gun->id,
        'name' => 'new loadout',
    ])->assertRedirect();

    assertDatabaseHas(Loadout::class, [
        'gun_id' => $gun->id,
        'name' => 'new loadout',
        'votes' => 0,
    ]);
});

test('a loadout can be viewed', function () {
    $loadout = Loadout::factory()->create();

    get('/loadouts/'.$loadout->id)
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Loadouts/Show')
            ->has('loadout')
        );
});

test('a loadout can be updated', function () {
    $gun = Gun::factory()->create();

    $loadout = Loadout::factory()->create([
        'name' => 'old loadout name',
    ]);

    put('/loadouts/'.$loadout->id, [
        'name' => 'new loadout name',
        'gun_id' => $gun->id,
    ])->assertRedirect();

    assertDatabaseHas(Loadout::class, [
        'name' => 'new loadout name',
        'gun_id' => $gun->id,
    ]);
});

test('a loadout can be deleted', function () {
    $loadout = Loadout::factory()->create();

    delete('/loadouts/'.$loadout->id)
        ->assertRedirect();

    assertModelMissing($loadout);
});
