<?php

namespace App\Repositories;
use illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index(){
        return $this->model->all();
    }

    public function show($id){
       return $this->model->findOrFail($id);
    }

    public function store(array $data){
       return $this->model->create($data);
    }


    public function update(array $data,$id){
       return $this->model->whereId($id)->update($data);
    }
    
    public function delete($id){
       $this->model->destroy($id);
    }
}
