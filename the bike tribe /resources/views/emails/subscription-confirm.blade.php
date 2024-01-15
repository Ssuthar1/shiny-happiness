@include('emails.includes.header')
<br>  
Dear User,
<br><br>  
You have successfully subscribe to our newsletter, please <a href="{{route('confirmSubscription',$mailInfo['emailHash'])}}" target="_blank"><strong>confirm your subscription by Click here.</strong></a> 

@include('emails.includes.footer')


