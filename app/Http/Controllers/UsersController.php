<?php

namespace myFavouriteAppliance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
      /**
     * Get all favorite appliance by user
     *
     * @return Response
     */
    public function myWishlist()
    {
        $my_wishlist= Auth::user()->appliances()->get();
        return view('users.mywishlist', compact('my_wishlist'));
    }

    /**
     * Send a email to a friend with a secure link to share wishlist
     * It is not implemented
     *
     */
    public function share()
    {

    }
}
