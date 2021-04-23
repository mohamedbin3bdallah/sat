Hello <i>{{ $data['email'] }}</i>,
<p>{{ $data['message'] }}.</p>
 
<p><u>Contact Form:</u></p>
 
<div>
<p><b>Name:</b>&nbsp;{{ $data['name'] }}</p>
<p><b>Company:</b>&nbsp;{{ $data['company'] }}</p>
<p><b>Phone:</b>&nbsp;{{ $data['phone'] }}</p>
</div>
 
Thank You,
<br/>
<i>{{ $data['email'] }}</i>