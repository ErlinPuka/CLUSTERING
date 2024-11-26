<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Produksi
 * 
 * @property int $id
 * @property int $id_kecamatan
 * @property int $tahun
 * @property int $produksi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kecamatan $kecamatan
 *
 * @package App\Models
 */
class Produksi extends Model
{
	protected $table = 'produksi';

	protected $casts = [
		'id_kecamatan' => 'int',
		'tahun' => 'int',
		'produksi' => 'int'
	];

	protected $fillable = [
		'id_kecamatan',
		'tahun',
		'produksi'
	];

	public function kecamatan()
	{
		return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
	}
}
