<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lokasi
 * 
 * @property int $id
 * @property string $kecamatan
 * @property string $luas_lahan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Produksi[] $produksis
 *
 * @package App\Models
 */
class Lokasi extends Model
{
	protected $table = 'lokasi';

	protected $fillable = [
		'kecamatan',
		'luas_lahan',
		'tahun'
	];

	public function produksis()
	{
		return $this->hasMany(Produksi::class, 'kecamatan');
	}
}
