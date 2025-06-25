<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Link;

class ShortLink extends Model
{
    protected $fillable = ['shortLink', 'link_id', 'count'];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}