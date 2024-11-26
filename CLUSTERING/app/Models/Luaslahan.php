<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Luaslahan
 * 
 * @property int $id
 * @property int $id_kecamatan
 * @property int $luas_lahan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $tahun
 * 
 * @property Kecamatan $kecamatan
 * @property Collection|Produksi[] $produksis
 * @property Collection|TbClustering[] $tb_clusterings
 *
 * @package App\Models
 */
class Luaslahan extends Model
{
	protected $table = 'luaslahan';

	protected $casts = [
		'id_kecamatan' => 'int',
		'luas_lahan' => 'int'
	];

	protected $fillable = [
		'id_kecamatan',
		'luas_lahan',
		'tahun'
	];

	public function kecamatan()
	{
		return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
	}

	public function produksis()
	{
		return $this->hasMany(Produksi::class, 'kecamatan');
	}

	public function tb_clusterings()
	{
		return $this->hasMany(TbClustering::class, 'id_kecamatan');
	}
}
