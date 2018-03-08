# WP-Profile
This function can be used with WP-Members Membership Plugin and it was created to replace [swpm_login_form] (which is assigned to membership login page) when the user has logged in.

The differents from the plugin's shortcode is that this function:  
1. Displays the first and the last name of logged user (instead of user_name) 
2. Displays the company of logged user Displays the expiration date in date format ('d M Y') 
3. Displays a message when the user is logged with his wp-user account and not with membership credentials that inform him about this situation (instead of login form) 
4. Does not appear the edit profil link The function can be used in any WP Site with the WP-Members Membership Plugin installed and can be added to functions.php file of child theme.  

It 's provides the shordcode [es_login_details], so it can be displayed anywhere in the site or just replace the [swpm_login_form] in 'membership login' page.  

Currently it does not accepts any parameters.  

Example of logged user membership page:  
Name _first_name 
Surname _last_name 
Company _company_name 
Subscription Type _Subscription_Type 
Expiration date 25 Jan 2019  
Logout  

Example of logged user with wp-user credentials:  
Dear _display_name, 
Your account does not belong to Subscribers list. If you want to see your profil as subscriber please logout and loggin with your subscriber credentials.
