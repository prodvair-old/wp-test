{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
  
    @if(get_field('osnovnoe'))
      <p class="text-uppercase font-weight-bold">{{ get_field('osnovnoe') }}</p>
    @endif

    @include('partials.content-page')

  @endwhile
  @include('partials.send-form')
@endsection
