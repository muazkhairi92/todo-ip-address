<?php

namespace App\Http\Controllers;

use App\Models\AllowedIp;
use App\Http\Requests\StoreAllowedIpRequest;
use App\Http\Requests\UpdateAllowedIpRequest;
use App\Http\Resources\AllowedIpResource;
use Illuminate\Http\Request;

class AllowedIpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allowedIps= AllowedIp::all();

        return $this->sendResponse('All todo list successfully retrieved.', AllowedIpResource::collection($allowedIps), 200);        }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllowedIpRequest $request)
    {
        $createdIp = AllowedIp::create($request->validated());

        return $this->sendResponse(' todo list successfully created.', new AllowedIpResource($createdIp), 200);       
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,AllowedIp $allowedIp)
    {
        $client_ip = $request->ip();

        if($allowedIp != $client_ip){
            $allowedIp->delete();   
            return $this->sendResponse('category successfully deleted.', null, 200);        
        }
        
        return $this->sendError('Could not delete own ip address', null,401);
    }
}