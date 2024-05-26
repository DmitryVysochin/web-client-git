<?php

namespace App\Models\Connect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ConnectSSHModel extends  Model
{
    use HasFactory;
    protected $table = "connects";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idUser',
        'ip',
        'port',
        'login',
        'loginGit',
        'passwordGit',
        'nameConnect',
        'pathToSite',
    ];

}
