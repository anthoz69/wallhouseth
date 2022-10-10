<?php

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('coupon can create', function () {
    $this->actingAs($user = \App\Models\User::factory()->create());
    $this->postJson('/backoffice/coupon', [
        'name' => 'test',
        'code' => 'TEST2022',
        'amount' => 10
    ])
        ->assertStatus(201);
    expect(Coupon::count())->toEqual(1);
});

test('coupon can update', function () {
    $this->actingAs($user = \App\Models\User::factory()->create());

    $this->postJson('/backoffice/coupon', [
        'name' => 'test',
        'code' => 'TEST2022',
        'amount' => 10
    ])
        ->assertStatus(201);
    expect(Coupon::count())->toEqual(1);

    $coupon = Coupon::find(1);
    $this->putJson("/backoffice/coupon/{$coupon->id}", [
        'name' => 'Sir',
        'code' => 'TESTSir2022',
        'amount' => 10
    ])
        ->assertStatus(200);

    expect($coupon->refresh()->name)->toEqual('Sir')
        ->and($coupon->refresh()->code)->toEqual('TESTSir2022')
        ->and($coupon->refresh()->amount)->toEqual(10);
});
