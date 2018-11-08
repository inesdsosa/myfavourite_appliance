<?php

namespace myFavouriteAppliance;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Appliance extends Model
{

    protected $fillable = [
        'title',
        'price',
        'reference',
        'source_url_id'
    ];

    public function users(){
        return $this->belongsToMany('User')->using(Wishlist);
    }

    /**
     * Determine whether a appliance has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) Wishlist::where('user_id', Auth::id())
            ->where('appliance_id', $this->id)
            ->first();
    }

}
