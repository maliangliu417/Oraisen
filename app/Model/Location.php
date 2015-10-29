<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jackpopp\GeoDistance\GeoDistanceTrait;

class Location extends Model {

    use GeoDistanceTrait;

    protected $fillable = ['name', 'lat', 'lng'];

}