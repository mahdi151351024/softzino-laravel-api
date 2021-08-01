<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface UserInterface{

    public function create(array $data);

    public function edit(array $data);

    public function all();

    public function delete($id);

    public function get($id);
}