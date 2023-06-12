<h3>{{ $mailData['title'] }}</h3>
<p>Please click the link below to verify your account!</p>
<a href="{{ route('verify.email',['token' => $mailData['token']]) }}">Click to here.</a>
