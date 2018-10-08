<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Mail;
use Setting;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\User;
use App\Bonus;
use App\Contact;
use App\CoinType;
use App\Document;
use App\Passbook;
use App\Promocode;
use App\KycDocument;
use App\TransactionHistory;
use App\NewsletterSubscription;
use App\Mail\SendMessage;
use App\ContactUs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('contact','check_subscription','add_subscription','contact_us')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ip = geoip()->getClientIP();
        $location = geoip()->getLocation($ip);
        $accredited = 0;

        if($location->country == 'United States'){
            if(Auth::user()->status == 0){
                return redirect('/kyc');
            }
            $accredited = 1;
        }


        if(empty(Auth::user()->name) || empty(Auth::user()->email) || empty(Auth::user()->mobile) || empty(Auth::user()->country) || empty(Auth::user()->state) || empty(Auth::user()->city) || empty(Auth::user()->address) || empty(Auth::user()->zip)) {
            $empty = 1;
        } else {
            $empty = 0;
        }
        $User = Auth::user()->status;
        $cointype = CoinType::where('status', '1')->get();
        $now = Carbon::now();
        $bonuses = Bonus::where('to','>=',$now)->get();

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

        if(Setting::get('kyc_approval')) {
            if($User) {
                return view('home',compact('cointype','bonuses','User','bitstampdetails','etherscandetails','xrpusddetails', 'accredited'));
            } else {
                return redirect('/kyc');
            }
        } else {
            return view('home',compact('cointype','bonuses','User','empty','bitstampdetails','etherscandetails','xrpusddetails', 'accredited'));
        }
    }

    public function profile(){

        return view('profile');
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
                'password' => 'required|confirmed|min:6',
                'old_password' => 'required',
            ]);

        $User = Auth::user();

        if(Hash::check($request->old_password, $User->password))
        {
            $User->password = bcrypt($request->password);
            $User->save();

            return back()->with('flash_success', trans('sessionflash.password_updated'));

        } else {
            return back()->with('flash_error', trans('sessionflash.new_old_passord_not_be_same'));
        }
    }

    public function profile_store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email|unique:users,email,'.Auth::user()->id,
            'mobile' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
        ]);

        try{
            $user = Auth::user();
            if($request->has('name')){
                $user->name = $request->name;
            }
            if($request->has('email')){
                $user->email = $request->email;
            }
            if($request->has('mobile')){
                $user->mobile = $request->mobile;
            }
            if($request->has('country')){
                $user->country = $request->country;
            }
            if($request->has('state')){
                $user->state = $request->state;
            }
            if($request->has('city')){
                $user->city = $request->city;
            }
            if($request->has('address')){
                $user->address = $request->address;
            }
            if($request->has('zip')){
                $user->zip = $request->zip;
            }
            if($request->has('coin_address')){
                $user->coin_address = $request->coin_address;
            }
            $user->save();
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function Address(Request $request){
        $this->validate($request, [
            'wallet_address' => 'required',
        ]);

        try{
            $client = new Client();
            $requestdata = $client->get('https://api.etherscan.io/api?module=account&action=balance&address='.$request->wallet_address.'&tag=latest');
            $response = json_decode($requestdata->getBody(),1);
            if($response['status'] == '0') {
                return back()->with('flash_error',trans('sessionflash.invalid_address'));
            }
            $user = Auth::user();
            if($request->has('wallet_address')){
                $user->coin_address = $request->wallet_address;
            }
            $user->save();
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function btcAddress(Request $request){
        $this->validate($request, [
            'btc_address' => 'required|confirmed',
        ]);

        try{
            $user = Auth::user();
            if($request->has('btc_address')){
                $user->btc_address = $request->btc_address;
            }
            $user->save();
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function download()
    {
        try{

            $KycDocument = KycDocument::where('user_id',Auth::user()->id)->get();
            $Kyc = Document::where('download', 1)->orderBy('order','asc')->get();
            return view('download',compact('Kyc','KycDocument'));

        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function downloadProcess(Request $request)
    {
        $this->validate($request, [
            'image.*' => 'required',
            // 'image.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        try{
            foreach ($request->image as $key => $image) {
                $Document = KycDocument::where('user_id', Auth::user()->id)
                            ->where('document_id', $key)
                            ->delete();

                KycDocument::create([
                    'url' => $image->store('kyc/documents'),
                    'user_id' => Auth::user()->id,
                    'document_id' => $key,
                    'status' => 'PENDING',
                ]);
            }
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function kyc()
    {
        try{

            $KycDocument = KycDocument::where('user_id',Auth::user()->id)->get();
            $Kyc = Document::where('download', 0)->orderBy('order','asc')->get();
            return view('kyc',compact('Kyc','KycDocument'));

        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function kycProcess(Request $request)
    {
        $this->validate($request, [
            'image.*' => 'required',
            // 'image.*' => 'image|mimes:jpeg,png,jpg',
        ]);

        try{
            foreach ($request->image as $key => $image) {
                $Document = KycDocument::where('user_id', Auth::user()->id)
                            ->where('document_id', $key)
                            ->delete();

                KycDocument::create([
                    'url' => $image->store('kyc/documents'),
                    'user_id' => Auth::user()->id,
                    'document_id' => $key,
                    'status' => 'PENDING',
                ]);
            }
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function emailRegulation(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        try{

            \Mail::to('aarnavinc@gmail.com')->send(new SendMessage($request));
            return back()->with('flash_success',trans('sessionflash.updated_successfully'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function referral(Request $request)
    {
        try{
            $User = User::where('referral_by', Auth::user()->id)->get();
            return view('referral',compact('User'));
        }catch(Exception $e){
            return back()->with('flash_error',$e->getMessage());
        }

    }

    public function coinStatus(Request $request){

        try{
            $client = new Client();
            if($request->type == 'XRP'){
                $requestdata = $client->get('https://www.bitstamp.net/api/v2/ticker/xrpusd');
            }
            if($request->type == 'ETH'){
                $requestdata = $client->get('https://api.etherscan.io/api?module=stats&action=ethprice&api');
            }
            if($request->type == 'BTC'){
                $requestdata = $client->get('https://www.bitstamp.net/api/v2/ticker/btcusd');
            }
            if(isset($requestdata)) {
                $response = json_decode($requestdata->getBody(),1);
            }
            $response['message'] = 'OK';
            if($request->promo != null) {
                $this->check_expiry($request->promo);
                $promo_code = Promocode::where('promo_code', $request->promo)->first();
                $history = TransactionHistory::where('user_id', Auth::user()->id)->where('promocode', $request->promo)->first();
                if($history) {
                  return response()->json(['message' => 'error', 'error' => 'promo_used'], 200);
                }
                if($promo_code) {
                    if($promo_code->status == 'EXPIRED') {
                        return response()->json(['message' => 'error', 'error' => 'promo_expired'], 200);
                    } else {
                        $response['promo_percent'] = $promo_code->percentage;
                    }
                } else {
                    return response()->json(['message' => 'error', 'error' => 'invalid_promo'], 200);
                }
            }
            return $response;
        }catch(Exception $e){
            return response()->json(['message' => 'error', 'error' => 'id_not_valid'], 200);
        }
    }

    public function check_expiry($promocode){
        try {
            $Promocode = Promocode::where('promo_code', $promocode)->get();
            foreach ($Promocode as $index => $promo) {
                if(date("Y-m-d") > $promo->expiration){
                    $promo->status = 'EXPIRED';
                    $promo->save();
                }
            }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    public function checkTransaction(Request $request) {
        $this->validate($request, [
            'tranx_id' => 'required|unique:transaction_histories,payment_id',
            'amount' => 'required',
            'cointype' => 'required'
            ],[
            'tranx_id.unique' => 'The Transaction Id has already been used.',
        ]);

        $transaction_id = $request->tranx_id;

        $amount = $request->amount;

        try {
            $Coin = CoinType::where('symbol',$request->cointype)->first();
            if($request->cointype == 'ETH'){
                $ether_id = $Coin->address;
                $client = new \GuzzleHttp\Client();
                $request = $client->get('https://api.blockcypher.com/v1/eth/main/txs/'.$transaction_id.'');
                $response = json_decode($request->getBody());

                if(strcasecmp($response->outputs[0]->addresses[0], substr($ether_id, 2)) == 0) {
                    if(($response->total/1000000000000000000 - $amount) > -0.005) {
                        return response()->json(['success' => 'Ok'], 200);
                    }else{
                        return response()->json(['error' => 'price_not_match'], 200);
                    }
                }else{
                    return response()->json(['error' => 'address_not_match'], 200);
                }
            }
            if($request->cointype=='BTC'){
                $bitcoin_id = $Coin->address;
                $client = new \GuzzleHttp\Client();
                $request = $client->get('https://api.blockcypher.com/v1/btc/main/txs/'.$transaction_id.'');
                $response = json_decode($request->getBody());

                if(in_array($bitcoin_id, $response->addresses)) {
                    if(($response->outputs[0]->value/100000000 - $amount) > -0.0005) {
                        return response()->json(['success' => 'Ok'], 200);
                    }else{
                        return response()->json(['error' => 'price_not_match'], 200);
                    }
                }else{
                    return response()->json(['error' => 'address_not_match'], 200);
                }
            }
            if($request->cointype=='XRP'){
                $ripple_id = $Coin->address;
                $client = new \GuzzleHttp\Client();
                $request = $client->get('https://data.ripple.com/v2/transactions/'.$transaction_id.'?binary=false');
                $response = json_decode($request->getBody());

                if($response->result == 'success') {
                    if($response->transaction->tx->Destination==$ripple_id ){
                        if(($response->transaction->tx->Amount/1000000 - $amount) > -0.5){
                            return response()->json(['success' => 'Ok'], 200);
                        }else{
                            return response()->json(['error' => 'price_not_match'], 200);
                        }
                    }else{
                        return response()->json(['error' => 'Failed'], 200);
                    }
                } else {
                    return response()->json(['error' => 'Failed'], 200);
                }
            }
            if($request->cointype=='USD'){
                return response()->json(['success' => 'Ok'], 200);
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json(['error' => 'id_not_valid'], 200);
        } catch(Exception $e){
            return response()->json(['error' => 'id_not_valid'], 200);
        }
    }

    public function Transaction(Request $request)
    {
        $this->validate($request,[
            'tranx_id' => 'required'
        ]);

       try{
            $user = Auth::user();
            if($user->coin_address != $request->coin_address) {
                $user->coin_address = $request->coin_address;
            }
            if($request->cointype=='XRP'){
                $payment_mode = $request->cointype;
                $user->XRP += $request->amount_new;
                $status = 'success';
            }
            if($request->cointype=='BTC'){
                $payment_mode = $request->cointype;
                $user->BTC += $request->amount_new;
                $status = 'pending';
            }
            if($request->cointype=='ETH'){
                $payment_mode = $request->cointype;
                $user->ETH += $request->amount_new;
                $status = 'pending';
            }
            if($request->cointype=='USD'){
                $payment_mode = $request->cointype;
                $status = 'pending';
            }
            $Transaction = new TransactionHistory;
            $Transaction->user_id = Auth::user()->id;
            $Transaction->price = $request->amount_new;
            $Transaction->payment_mode = $payment_mode;
            $Transaction->bonus_point = $request->bonus_point;
            $Transaction->referal_code = $request->referal_code;
            $Transaction->promocode = $request->promo_code;
            $Transaction->payment_id = $request->tranx_id;;
            $Transaction->status = $status;
            $Transaction->ico = $request->amount_ctc;
            $Transaction->ico_price = Setting::get('coin_price');
            $Transaction->save();

            $user->save();

            if($request->cointype=='XRP'){
                $passbook = $this->passbook($Transaction->id);
            }

            return back()->with('flash_success',trans('sessionflash.transaction_successfully_status_on').$status);
        } catch(Exception $e) {
            return back()->with('flash_error',$e->getMessage());
        }
    }

    public function passbook($id){
            $transaction = TransactionHistory::find($id);
            $user = User::find($transaction->user_id);

            $passbook = new Passbook;
            $passbook->user_id = $transaction->user_id;
            $passbook->ico = $transaction->ico;
            $passbook->via = 'PURCHASE';
            $passbook->save();
            $discount = $user->ico_bonus;
            if($transaction->bonus_point>0){
                $discount_bnc = $transaction->ico*($transaction->bonus_point/100);
                $discount += $discount_bnc;
                $passbook = new Passbook;
                $passbook->user_id = $transaction->user_id;
                $passbook->ico = $discount_bnc;
                $passbook->via = 'BONUS';
                $passbook->save();
            }
            if($user->referral_by != ''){
                $discount_ref = $transaction->ico*(Setting::get('referral_bonus')/100);
                // $discount += $discount_ref;
                $users = User::find($user->referral_by);
                $users->ico_bonus += $discount_ref;
                $users->save();

                $passbook = new Passbook;
                $passbook->user_id = $user->referral_by;
                $passbook->ico = $discount_ref;
                $passbook->via = 'REFERRAL';
                $passbook->save();
            }
            if($transaction->promocode!=''){
                $promo = Promocode::where('promo_code', $transaction->promocode)->first();
                $discount_promo = $transaction->ico*($promo->percentage/100);
                $discount += $discount_promo;
                $passbook = new Passbook;
                $passbook->user_id = $transaction->user_id;
                $passbook->ico = $discount_promo;
                $passbook->via = 'PROMOCODE';
                $passbook->save();
            }


            $user->ico_balance += $transaction->ico;
            $user->ico_bonus = $discount;
            $user->save();
            return response()->json(['success' => 'Ok'], 200);

    }

    public function getTransaction(Request $request)
    {
        $balance = Passbook::where('user_id', Auth::user()->id)->where('via', 'REFERRAL')->sum('ico');
        $Transactions = TransactionHistory::with('user')->where('user_id',Auth::user()->id)->get();
        return view('transactions',['Transactions' => $Transactions, 'referral_balance' => $balance]);
    }

    public function contact(Request $request)
    {
        try{

            $contact = $request->all();

            Contact::create($contact);

            return redirect('https://aarnav.io/contact-us.html');

        }

        catch (Exception $e) {
            return redirect('https://aarnav.io/contact-us.html');
        }
    }
    public function check_subscription(Request $request){
        $this->validate($request, [
            'email' => 'email',
        ]);
        $check_exists = NewsletterSubscription::where('email',$request->email)->first();
        if($check_exists){
            return 1;
        }
        return 0;
    }
    public function add_subscription(Request $request){
        $this->validate($request, [
            'email' => 'email',
        ]);
        $subscription = new NewsletterSubscription();
        $subscription->email = $request->email;
        $subscription->status = 0;
        $subscription->save();
        return response()->json(['status' => 1], 200);
    }
    public function contact_us(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email',
            'phone' => 'required|numeric',
            'country' => 'required',
            'message' => 'required'
        ]);
        $contact = new ContactUs();
        $contact->email = $request->email;
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->country = $request->country;
        $contact->message = $request->message;
        $contact->is_replied = 0;
        $contact->save();
        return response()->json(['status' => 1], 200);
    }

}
