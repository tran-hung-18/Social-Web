<h3>{{ $mailData['title'] }}</h3>
<p>Loading</p>
<a href="{{ route('verify-email',['token' => $mailData['token']]) }}">Click to here.</a>
