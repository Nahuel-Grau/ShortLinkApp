<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Link extends Model
{
    protected $fillable = ['link', 'user_id', 'expires_at'];

    public function shortLink()
    {
        return $this->hasOne(ShortLink::class);
    }
}