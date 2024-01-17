<?php

/* Global Variable for Website */

return [  
  'permissions' => ['roles-list','roles-create','roles-edit','roles-delete','view-admin','add-admin','edit-admin','delete-admin','view-customers','add-customers','edit-customers','delete-customers','view-products','add-products','edit-products','delete-products','view-category','add-category','edit-category','delete-category','view-orders','add-orders','edit-orders','delete-orders','delete-banners','view-banners','add-banners','edit-banners','delete-banners','view-settings','edit-settings','view-products-inventory','product-inventory-add','product-inventory-edit','product-inventory-delete','web-settings'], 
  'roles' => ['Super Admin','Admin','Sub Admin','Customer'], 

  /*Note :-  if you select the option type, then give "|" to sepret special option. [ex. => "Active|Inactive"] */ 
  'settingOptionType' => [
    'logo'            => ['option_name'=>'Website Logo' ,'option_type'=>'file'],
    'footer_logo'            => ['option_name'=>'Footer Logo' ,'option_type'=>'file'],
    'facebook_link'            => ['option_name'=>'Facebook Link' ,'option_type'=>'test'],
    'twitter_link'            => ['option_name'=>'Twitter Link' ,'option_type'=>'test'],
    'instagram_link'            => ['option_name'=>'Instagram Link' ,'option_type'=>'test'],
    'copyright_message'            => ['option_name'=>'Copyright Message' ,'option_type'=>'test'],
  ],
  'paginateValue' => '10',
  'currency' => '₹',
  'razor_key' => 'rzp_test_IOPnSrcjVJZino',
  'razor_secret' => 'CKvLBBeMkOmtL0rl6diZUtCu', 
];
