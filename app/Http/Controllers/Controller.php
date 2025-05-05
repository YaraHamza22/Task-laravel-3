<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function success($data , $message = 'Operation successful' , $code =200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message ,
            'data' => $data
        ], $code);
    }

    protected function error($message = 'An error occurred',$code =500 ,$errors =null){
        $response =[
            'status' => 'error',
            'message' => $message,
        ];
        if($errors)
        {
           $response['error'] = $errors;
        }
        return response()->json($response, $code);
    }
}


