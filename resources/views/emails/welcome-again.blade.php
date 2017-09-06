@component('mail::message')
# Introduction

The body of your message.

- one

- two

- three

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::panel', ['url' => ''])
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam consequuntur ducimus eaque earum est id impedit, laudantium maxime molestiae officia officiis placeat possimus quas repellat repudiandae sapiente, similique, veritatis.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
