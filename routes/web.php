<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemberComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');
Route::get('/user', UserComponent::class)->middleware('auth')->name('user');
Route::get('/member', MemberComponent::class)->middleware('auth')->name('member');
Route::get(('/login'), LoginComponent::class)->name('login');
Route::get(('/logout'), [LoginComponent::class, 'keluar'])->name('logout');