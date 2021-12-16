@component('mail::message')
# Contact Us Mail Feedback

<p>Name: {{$data['name']}}</p>
<p>Name: {{$data['email']}}</p>
<p>Name: {{$data['phone']}}</p>
<p>Name: {{$data['message']}}</p>


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
