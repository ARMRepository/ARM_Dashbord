<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHistory;
use Setting;
use Storage;
use Auth;
use DB;
use GuzzleHttp\Client;
use App\Http\Controllers\HomeController;
use App\User;
use App\KycDocument;
use App\Coinadmin;
use App\Contact;
use App\NewsletterSubscription;
use Mail;


class AdminController extends Controller
{

     public function dashboard()
    {
        try{

            $client = new Client;
            $xrpusd = $client->get('https://www.bitstamp.net/api/v2/ticker/xrpusd');
            $xrpusddetails = json_decode($xrpusd->getBody(),true);
            $xrpusddetails = $xrpusddetails['last'];

            $etherscan = $client->get('https://api.etherscan.io/api?module=stats&action=ethprice');
            $etherscandetails = json_decode($etherscan->getBody(),true);
            $etherscandetails = $etherscandetails['result']['ethusd'];

            $bitstamp = $client->get('https://www.bitstamp.net/api/v2/ticker/btcusd/');
            $bitstampdetails = json_decode($bitstamp->getBody(),true);
            $bitstampdetails = $bitstampdetails['last'];

            $History = TransactionHistory::with('user')->take(10)->orderBy('id','desc')->get();

            $Card['total_ico'] = User::sum(DB::raw('ico_balance + ico_bonus'));
            $Card['total_btc'] = User::sum(DB::raw('BTC'));
            $Card['total_eth'] = User::sum(DB::raw('ETH'));
            $Card['total_xrp'] = User::sum(DB::raw('XRP'));

            return view('coinadmin.home',compact('bitstampdetails','etherscandetails','xrpusddetails','History', 'Card'));
        }
        catch(Exception $e){
            return back()->with('flash_error','Something Went Wrong with Dashboard!');
        }
    }
    public function history()
    {
    	$History = TransactionHistory::with('user')->get();

    	return view('coinadmin.history.index',compact('History'));
    }

    public function settings()
    {
         return view('coinadmin.settings.settings');
    }

    public function settings_store(Request $request)
    {

        $this->validate($request,[
                'site_title' => 'required',
                'site_icon' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
                'site_logo' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
                'coin_name' => 'required',
                'coin_symbol' => 'required',
                'coin_price' => 'required',
                'referral_bonus' => 'required',
                'coin_address' => 'required',
            ]);


        if($request->hasFile('site_icon')) {

            $site_icon = $request->site_icon->store('settings');
            Setting::set('site_icon', $site_icon);
        }



        if($request->hasFile('site_logo')) {
            $site_logo = $request->site_logo->store('settings');
            Setting::set('site_logo', $site_logo);
        }

        if($request->hasFile('site_email_logo')) {
            $site_email_logo = $request->site_email_logo->store('settings');
            Setting::set('site_email_logo', $site_email_logo);
        }

        Setting::set('site_title', $request->site_title);
        Setting::set('site_copyright', $request->site_copyright);
        // Setting::set('store_link_android', $request->store_link_android);
        // Setting::set('store_link_ios', $request->store_link_ios);
        Setting::set('coin_name', $request->coin_name);
        Setting::set('coin_symbol', $request->coin_symbol);
        Setting::set('coin_price', $request->coin_price);
        Setting::set('referral_bonus', $request->referral_bonus);
        Setting::set('coin_address', $request->coin_address);
        Setting::set('kyc_approval', $request->kyc_approval == 'on' ? 1 : 0 );

        Setting::save();

        return back()->with('flash_success','Settings Updated Successfully');


    }

     public function historySuccess($id)
    {
            $History = TransactionHistory::findOrFail($id);
            (new HomeController)->passbook($id);
            $History->status = "success";
            $History->save();

            return back()->with('flash_success','Settings Updated Successfully');
    }

     public function historyFailed($id)
    {
            $History = TransactionHistory::findOrFail($id);

            $History->status = "failed";
            $History->save();

            return back()->with('flash_success','Status Updated Successfully');
    }

    public function userdocument_approve(Request $request)
    {
        $Kyc = KycDocument::where('user_id',$request->user_id)
                    ->where('document_id',$request->doc_id)
                    ->first();

        $Kyc->status = $request->status;

        $Kyc->save();

         return back()->with('flash_success','Status Updated Successfully');

    }

    public function userdocument_reject(Request $request)
    {
        $Kyc = KycDocument::where('user_id',$request->user_id)
                    ->where('document_id',$request->doc_id)
                    ->first();

        $Kyc->status = $request->status;

        $Kyc->save();

         return back()->with('flash_success','Status Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('coinadmin.account.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile_update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:coinadmins,email,'.Auth::guard('coinadmin')->user()->id,
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
        ]);

        try{
            $admin = Auth::guard('coinadmin')->user();
            $admin->name = $request->name;
            $admin->email = $request->email;

            if($request->hasFile('picture')){
                $admin->picture = $request->picture->store('admin/profile');
            }
            $admin->save();

            return redirect()->back()->with('flash_success','Profile Updated');
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('coinadmin.account.change-password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function password_update(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        try {

           $Admin = Coinadmin::find(Auth::guard('coinadmin')->user()->id);

            if(password_verify($request->old_password, $Admin->password))
            {
                $Admin->password = bcrypt($request->password);
                $Admin->save();

                return redirect()->back()->with('flash_success','Password Updated');
            }
        } catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }

    public function translation(){

        try{
            return view('coinadmin.translation');
        }

        catch (Exception $e) {
             return back()->with('flash_error', trans('api.something_went_wrong'));
        }
    }

    public function contacts()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();

        return view('coinadmin.contact.index', compact('contacts'));
    }
    public function newsletter(){
        $newsletters = NewsletterSubscription::orderBy('id', 'desc')->get();
        return view('coinadmin.newsletter.index', compact('newsletters'));
    }
    public function subscription_status($id,$status){
        $newsletters = NewsletterSubscription::where('id',$id)->first();
        if($newsletters){
            $newsletters->status = $status == 0 ? 1 : 0;
            $newsletters->save();
            return back()->with('flash_success', 'Status updated successfully');
        }
         return back()->with('flash_error', trans('api.something_went_wrong'));
    }
    public function compose_newsletter(){
        $newsletters = NewsletterSubscription::where('status',0)->orderBy('id', 'desc')->get();
        return view('coinadmin.newsletter.compose', compact('newsletters'));
    }
    public function send_newsletter(Request $request){
        $this->validate($request,[
            'message' => 'required',
        ]);
        if($request->has('subscription_email_id') && !empty($request->has('subscription_email_id'))){
            foreach($request->subscription_email_id as $email){
                Mail::send('coinadmin.email', ['data' => $request->message], function ($email,$message)
                {
                    $message->from('aarnavinc@gmail.com', 'Aarnav');
                    $message->to($email);
                });
            }
            return back()->with('flash_success', 'Newsletter send successfully');
        }else{
            return back()->with('flash_error', trans('api.something_went_wrong'));
        }
    }
}
