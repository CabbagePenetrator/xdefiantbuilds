<?php

use App\Models\Attachment;
use App\Models\Category;
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

test('the loadouts page can be viewed', function () {
    $category = Category::factory()->create([
        'name' => 'assault',
    ]);

    $gun = Gun::factory()->for($category)->create();

    Loadout::factory()->for($gun)->count(3)->create();

    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Loadouts/Index')
            ->has('loadouts', 3)
            ->has('categories', 1)
        );
});

test('loadouts for a category can be viewed', function () {
    $category = Category::factory()->create();

    $gun = Gun::factory()->for($category)->create();

    Loadout::factory()->count(3)->for($gun)->create();

    get('/'.$category->name.'/loadouts')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Categories/Loadouts/Index')
            ->has('loadouts', 3)
            ->has('categories', 1)
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

    expect($loadout->user_id)->toBe($this->user->id);

    expect($loadout->gun_id)->toBe($gun->id);

    expect($loadout->attachments()->count())->toBe(3);
});

test('a loadout can be viewed', function () {
    $loadout = Loadout::factory()->create();

    get('/loadouts/'.$loadout->id)
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Loadouts/Show')
            ->has('loadout', fn (Assert $page) => $page
                ->where('name', $loadout->name)
                ->etc()
            )
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
