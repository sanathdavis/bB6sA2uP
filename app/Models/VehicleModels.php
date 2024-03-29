<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModels extends Model {

  protected $guarded = ['id'];
  public function make() {
    return $this->belongsTo(VehicleMakes::class, 'vehicle_make_id');
  }
}
