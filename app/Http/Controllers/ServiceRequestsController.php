<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceRequests;
use App\Models\VehicleMakes;
use App\Models\VehicleModels;

use App\Meliorate\Constants\ServiceStatus;
use App\Meliorate\ViewHelper;

class ServiceRequestsController extends Controller {

  /**
   * [Display a paginated list of Service Requests in the system]
   * @return view
   */
  public function index(){
    $requests = ServiceRequests::getAllRequests(session('search'));
    return view('index',compact('requests'));
  }
  /**
   * [Display the form for adding a new Service Requests]
   * @return view
   */
  public function add(){  
    $makes = VehicleMakes::all();
    return view('add', compact('makes'));
  }
  /**
   * [Store the new Service Request]
   * @return redirect
   */
  public function store(Request $request){
    $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'email' => 'required|email',
      'make' => 'required',
      'model' => 'required',
      'description' => 'required',
    ]);   

    ServiceRequests::createRequest($request);

    $request->session()->flash('flash_level', 'success');
    $request->session()->flash('flash_message', 'New service request created');

    return redirect(route('home'));
  }
  /**
   * [Display the form for editing an existing Service Requests]
   * @param  ServiceRequests $serviceRequest
   * @return view
   */
  public function edit(ServiceRequests $serviceRequest){
    $makes = VehicleMakes::all();
    $statusOptions = ServiceStatus::getStatusOptions();
    $selectedModel = VehicleModels::find($serviceRequest->vehicle_model_id);
    $selectedMake = $selectedModel->make ?? '';
    $models = $selectedMake->models ?? [];
    return view('edit', compact(
      'makes',
      'statusOptions',
      'serviceRequest',
      'models',
      'selectedMake'
    ));
  }
  /**
   * [Update an existing Service Request]
   * @return redirect
   */
  public function update(Request $request, ServiceRequests $serviceRequest){
    $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'email' => 'required|email',
      'make' => 'required',
      'model' => 'required',
      'description' => 'required',
      'status' => 'required',
    ]);

    ServiceRequests::updateRequest($serviceRequest, $request);
    
    $request->session()->flash('flash_level', 'success');
    $request->session()->flash('flash_message', 'Service request edited');
    return redirect(route('home'));
  }
  /**
   * [Delete an existing Service Request]
   * @return redirect
   */
  public function delete(Request $request, ServiceRequests $serviceRequest){
    $serviceRequest->delete();

    $request->session()->flash('flash_level', 'success');
    $request->session()->flash('flash_message', 'Service request deleted');
    
    return redirect(route('home'));
  }   
  /**
   * [Generate the Models dropdown from make id]
   * @return json
   */
  public function getModels(Request $request, $makeId){
    if ($request->ajax()){
      $make = VehicleMakes::find($makeId);
      if ($make) {
        $models = $make->models;
        $viewHelper = new ViewHelper();
        $modelDropdown = $viewHelper->dropdown('Vehicle Model', $models);
        return response()->json($modelDropdown);
      }
    }
    return abort(403);
  }
  /**
   * [Store search in session]
   * @return json
   */
  public function search(Request $request){
    session(['search' => $request->search]);
    return redirect(route('home'));
  }  
}
