@extends('app')
@section('content')
<div class="md:grid md:grid-cols-12 md:gap-x-16 mb-20 lg:mb-0 mt-16 md:pb-64 relative contact-page">
  <div class="md:col-span-full lg:col-span-3 lg:col-start-3 text-lg font-europa-light font-light contact-page__imprint">
    {!! $data->imprint !!}
  </div>
  <div class="md:col-span-full lg:col-span-4 lg:col-start-6  contact-page__toc">
    {!! $data->toc !!}
  </div>
</div>
@endsection