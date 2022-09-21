@component('mail::message')
Hello Admin,  {{-- use double space for line break --}}
Your new subscription for Charming Pets! {{$mail}}
Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Charming Pets team.
@endcomponent