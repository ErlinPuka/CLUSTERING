<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbClustering
 * 
 * @property int $id
 * @property int $id_kecamatan
 * @property string $tahun
 * @property int $luas_lahan
 * @property int $produksi
 * @property string $cluster
 * @property string|null $data_hash
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Kecamatan $kecamatan
 *
 * @package App\Models
 */
class TbClustering extends Model
{
	protected $table = 'tb_clustering';

	protected $casts = [
		'id_kecamatan' => 'int',
		'luas_lahan' => 'int',
		'produksi' => 'int'
	];

	protected $fillable = [
		'id_kecamatan',
		'tahun',
		'luas_lahan',
		'produksi',
		'cluster',
		'data_hash'
	];

	public function kecamatan()
	{
		return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
	}
}
