<?php

use App\Models\Attachment;
use App\Models\Gun;
use App\Models\Loadout;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
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

    $attachments = Attachment::factory()->count(3)->create();

    post('/loadouts', [
        'gun_id' => $gun->id,
        'attachments' => $attachments->pluck('id')->all(),
        'name' => 'new loadout',
    ])->assertRedirect();

    $loadout = Loadout::where('name', 'new loadout')->first();

    expect($loadout->gun_id)->toBe($gun->id);

    expect($loadout->attachments()->count())->toBe(3);
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

    $attachments = Attachment::factory()->count(4)->create();

    $loadout = Loadout::factory()->has(Attachment::factory())->create([
        'name' => 'old loadout name',
    ]);

    put('/loadouts/'.$loadout->id, [
        'gun_id' => $gun->id,
        'attachments' => $attachments->pluck('id')->all(),
        'name' => 'new loadout name',
    ])->assertRedirect();

    $loadout = Loadout::where('name', 'new loadout name')->first();

    expect($loadout->gun_id)->toBe($gun->id);

    expect($loadout->attachments()->count())->toBe(4);
});

test('a loadout can be deleted', function () {
    $loadout = Loadout::factory()->create();

    delete('/loadouts/'.$loadout->id)
        ->assertRedirect();

    assertModelMissing($loadout);
});
