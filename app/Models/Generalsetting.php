<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    protected $fillable = ['logo', 'favicon', 'title','copyright','colors','loader','admin_loader','talkto','disqus','currency_format','withdraw_fee','withdraw_charge','shipping_cost','mail_driver','mail_host','mail_port','mail_encryption','mail_user','mail_pass','from_email','from_name','is_affilate','affilate_charge','affilate_banner','fixed_commission','percentage_commission','multiple_shipping','is_verification_email','wholesell','is_capcha','error_banner_404','error_banner_500','popup_title','popup_text','popup_background','invoice_logo','user_image','is_secure','paypal_business','footer_logo','paytm_merchant','maintain_text','flash_count','hot_count','new_count','sale_count','best_seller_count','popular_count','top_rated_count','big_save_count','trending_count','page_count','seller_product_count','wishlist_count','min_price','max_price','product_page','post_count','wishlist_page','decimal_separator','thousand_separator','version','is_reward','reward_point','reward_dolar','physical','digital','license','affilite'];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
        $name = str_replace('(', '', $name);
        $name = str_replace(')', '', $name);

        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if (file_exists(public_path().'/assets/images/'.$oldname)) {
                unlink(public_path().'/assets/images/'.$oldname);
            }
        }
    }
}
