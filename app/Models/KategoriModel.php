<?php

namespace App\Models;

use App\Models\BaseModel;

class KategoriModel extends BaseModel
{
    protected $table = 'kategori_buku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kategori', 'slug'];
}