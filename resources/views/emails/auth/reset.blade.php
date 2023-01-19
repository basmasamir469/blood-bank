<x-mail::message>
# Introduction

<h2>Welcome {{$client->name}}</h2>

<x-mail::button :url="'http://localhost:8000/changepassword'">
Reset
</x-mail::button>
<p>Your reset code is {{$client->pin_code}}</p>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
