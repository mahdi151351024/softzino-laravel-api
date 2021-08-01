<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface AuthInterface{

    public function register(array $data);

    public function login(array $data);

    public function logout();
}