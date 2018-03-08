<?php 
function replace_swpm_login_form_shortcode_function(){
    global $wpdb;
    $cur_prefix = $wpdb->prefix;
    $current_user = wp_get_current_user();
   
    $user_login_get =  $current_user->user_login;
    $current_member_row = $wpdb->get_row("SELECT * FROM {$cur_prefix}swpm_members_tbl WHERE user_name = '{$user_login_get} '");
    $name = $current_member_row->first_name;
    $r = (!empty($name)) ? '<div class="prof-label">Name </div>' . '<div class="prof-value">' . $name . '</div>' : '';
    
    $surname = $current_member_row->last_name;
    $r .= (!empty($surname)) ? '<div class="prof-label">Surname </div>' . '<div class="prof-value">' . $surname . '</div>' : '';
    
    $company_name = $current_member_row->company_name;
    $r .= (!empty($company_name)) ? '<div class="prof-label">Company </div>' . '<div class="prof-value">' . $company_name . '</div>' : '';
    $membership_level = $current_member_row->membership_level;
        $subscription_level = $wpdb->get_row("SELECT * FROM {$cur_prefix}swpm_membership_tbl WHERE id = '{$membership_level} '");
        $subscription_type = $subscription_level->alias;
    $r .= (!empty($subscription_type)) ? '<div class="prof-label">Subscription Type </div>' . '<div class="prof-value">' . $subscription_type . '</div>' : '';
    $subscription_starts = $current_member_row->subscription_starts;
        $subscription_starts = explode('-', $subscription_starts);
        $subscription_starts_year = $subscription_starts[0];
        $subscription_starts_month = $subscription_starts[1];
        $subscription_starts_day = $subscription_starts[2];  
    $subscription_period = $subscription_level->subscription_period;
    $subscription_duration_type = $subscription_level->subscription_duration_type;
        
    $the_date = implode("-", $subscription_starts);
    if($subscription_duration_type==4){
        $expirationdate = date('Y-m-d', strtotime(  $the_date . ' + ' .  $subscription_period . ' year'));
    }
    elseif($subscription_duration_type==3){
        $expirationdate = date('Y-m-d', strtotime(  $the_date . ' + ' .  $subscription_period . ' month'));
    }
    elseif($subscription_duration_type==2){
                $expirationdate = date('Y-m-d', strtotime(  $the_date . ' + ' .  $subscription_period . ' week'));
    }
    elseif($subscription_duration_type==1){
        $expirationdate = date('Y-m-d', strtotime(  $the_date . ' + ' .  $subscription_period . ' day'));
    }
    elseif($subscription_duration_type==5){
        $expirationdate = $subscription_period;
    }
    $expirationdate = explode('-', $expirationdate);
    $subscription_starts_year = $expirationdate[0];
    $subscription_starts_month = $expirationdate[1];
    $subscription_starts_day = $expirationdate[2];  
    $date_final = new DateTime();
    $date_final->setDate($subscription_starts_year, $subscription_starts_month, $subscription_starts_day);
    $r .= (!empty($current_member_row->subscription_starts)) ? '<div class="prof-label">Expiration date </div>' . '<div class="prof-value">' . $date_final->format('d M Y') . '</div>': '';
    
    $get_home_url = get_home_url();
    $r .= (!empty($name)) ? '<br><a href="/?swpm-logout=true">Logout</a>' : 'Dear ' . $current_user->display_name . ',<br>Your account does not belong to Subscribers list. If you want to see your profil as subscriber please logout and loggin with your subscriber credentials.';
    $r_login_form = do_shortcode( '[swpm_login_form]' );
    return $r; 
}
add_shortcode( 'es_login_details', 'replace_swpm_login_form_shortcode_function' );
?>
