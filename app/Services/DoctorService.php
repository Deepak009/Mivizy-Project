<?php

namespace App\Services;

use App\Models\Doctor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use DB;



class DoctorService
{ 
    
    protected $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }

  
    public function create($payload)
    {   
       
        try{
            DB::beginTransaction();
            $model = new $this->model;
            // filter out the allowable payload
            $payload = collect($payload);
            $payload = $payload->only($this->model->getFillable())->toArray();
            $password = $payload["password"]??randomString(8);
            $model->fill($payload);
			$model->password = bcrypt($password);
            $model->save();

        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
		return $model;

       

    }



}
