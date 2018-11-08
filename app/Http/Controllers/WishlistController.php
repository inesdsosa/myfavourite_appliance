<?php

namespace myFavouriteAppliance\Http\Controllers;

use myFavouriteAppliance\Appliance;
use myFovouriteAppliance\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class WishlistController extends Controller
{

    /**
     * Show a list of appliance and navbar to login y register
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderby = Input::get('orderby');
        if (isset($orderby) and in_array($orderby, array('title', 'price'))){  // array orden añadir config
             $appliances = Appliance::orderBy($orderby, 'asc')->paginate(5);
        }else {
            $appliances = Appliance::paginate(5);
        }
        return view('wishlist.index', compact('appliances'));
    }

    /**
     * Add appliance to wishlist
     *
     * @param  String $appliance_id
     * @return Response
     */
    public function addWishlist($appliance_id)
    {

        $myWishlist= Auth::user()->appliances()->where('appliance_id',$appliance_id)->first();

        if(isset($myWishlist->id))
        {
            return redirect()->back()->with('message', 'This item is already in your wishlist!');
        }
        else {
            Auth::user()->appliances()->attach($appliance_id);
            return back();
        }
    }

    /**
     * Del appliance to wishlist
     *
     * @param  String $appliance_id
     * @return Response
     */

    public function delWishlist($appliance_id)
    {
        Auth::user()->appliances()->detach($appliance_id);
        return back();
    }
}
