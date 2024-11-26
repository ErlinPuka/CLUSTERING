<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kecamatan
 * 
 * @property int $id
 * @property string $kecamatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Kecamatan extends Model
{
	protected $table = 'kecamatan';

	protected $fillable = [
		'kecamatan'
	];
}
