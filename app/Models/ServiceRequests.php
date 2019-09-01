<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Meliorate\Constants\ServiceStatus;

class ServiceRequests extends Model {
  use SoftDeletes;
  const RECORDS = 20;
  protected $guarded = ['id'];

  public static function getAllRequests($search = null){
    if ($search) {
      $query = self::join('vehicle_models', 'service_requests.vehicle_model_id', '=', 'vehicle_models.id')
      ->join('vehicle_makes', 'vehicle_models.vehicle_make_id', '=', 'vehicle_makes.id');
      $query->where(function ($q) use ($search) {
        $q->where('client_name', 'like', '%' . $search . '%');
        $q->orWhere('client_phone', 'like', '%' . $search . '%');
        $q->orWhere('client_email', 'like', '%' . $search . '%');
        $q->orWhere('service_requests.status', 'like', '%' . $search . '%');
        $q->orWhere('vehicle_models.title', 'like', '%' . $search . '%');
        $q->orWhere('vehicle_makes.title', 'like', '%' . $search . '%');
      });
      $query->select(
        'service_requests.id',
        'service_requests.client_name',
        'service_requests.status',
        'service_requests.updated_at'
      );
      return $query->orderBy('service_requests.updated_at', 'desc')->paginate(self::RECORDS);
    }
    return self::orderBy('updated_at', 'desc')->paginate(self::RECORDS);
  }

  public static function createRequest($data){
    self::create([
      'client_name'      => $data->name,
      'client_phone'     => $data->phone,
      'client_email'     => $data->email,
      'vehicle_model_id' => $data->model,
      'status'           => ServiceStatus::NEW_REQUEST,
      'description'      => $data->description,
    ]);
  }

  public static function updateRequest($serviceRequest, $data){
    $serviceRequest->update([
      'client_name'      => $data->name,
      'client_phone'     => $data->phone,
      'client_email'     => $data->email,
      'vehicle_model_id' => $data->model,
      'status'           => $data->status,
      'description'      => $data->description,
    ]);
  }
}
