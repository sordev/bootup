@extends('email.general')
@section('emailbody')
<h3>Сайн байна уу {{{$user->fullname}}}</h3>
<p>
Танд {{{$fullname}}} Бүүтап -р дамжуулан дараах захиаг илгээжээ
</p>
<p>
{{{$mailmessage}}}
</p>
@stop