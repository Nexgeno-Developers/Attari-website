@php

$title = !empty(trim($__env->yieldContent('page.title'))) ? str_replace(['&nbsp;', '&amp;', '&amp;amp;'], ['&amp;', '&', '&'], htmlspecialchars_decode($__env->yieldContent('page.title'))) : 'VMware vSphere, AWS Cloud, Azure Cloud, Windows Server Hybrid and CCNA Training Institute, Book Free DEMO - Attari Classes';

$description = !empty(trim($__env->yieldContent('page.description'))) ? str_replace(['&nbsp;', '&amp;', '&amp;amp;'], ['&amp;', '&', '&'], htmlspecialchars_decode($__env->yieldContent('page.description'))) :
'Attari Classes provides Hands-on Practical Training, Book FREE DEMO, Topic wise Recorded Lectures on LMS, Online & Classroom Training options'; 
$description = strip_tags($description);



$page_type = !empty(trim($__env->yieldContent('page.type'))) ? $__env->yieldContent('page.type') : 'website';

$publish_time = trim($__env->yieldContent('page.publish_time'));
$modified_time = trim($__env->yieldContent('page.modified_time'));

$url = url()->current();

@endphp

@php
    $currentPath = request()->path();
    $canonicalUrl = url()->current();

    if ((Str::startsWith($currentPath, 'category/') || $currentPath === 'blog') && request()->has('page')) {
        $page = request()->get('page');
        $canonicalUrl .= '?page=' . $page;
    }
@endphp

{{--
@if (strpos(request()->path(), 'windows-server-hybrid-training-') !== false)
<meta name="robots" content="noindex, follow">
@endif --}}
<title>@php echo htmlspecialchars_decode($title) @endphp</title>
<meta name="theme-color" content="#000000">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="NEXGENO">
<meta name="title" content="@php echo htmlspecialchars_decode($title) @endphp">
<meta name="description" content="@php echo htmlspecialchars_decode($description) @endphp">
{{-- <meta name="keywords" content="example, keywords, meta tags"> --}}
<meta name="robots" content="index, follow">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:type" content="{{ $page_type }}">
<meta property="og:site_name" content="{{ url('') }}">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="@php echo htmlspecialchars_decode($title) @endphp">
<meta property="og:description" content="@php echo htmlspecialchars_decode($description) @endphp">
@if(!empty($__env->yieldContent('page.published_time') || $__env->yieldContent('page.modified_time')))

{{--<meta property="article:publisher" content="" />
<meta property="article:section" content="Standard" />--}}
<meta property="article:published_time" content="{{ $publish_time }}" />
<meta property="article:modified_time" content="{{ $modified_time }}" />

@endif
<!----------------- og tag ------------------->
<meta property="og:image" content="{{ asset('assets/frontend/images/cropped-header-logo-1.webp') }}">
<meta property="og:image:width" content="500">
<meta property="og:image:height" content="500">
<meta property="og:image:type" content="image/png" />

<!----------------- canonical ------------------->

<link rel="canonical" href="{{ $canonicalUrl }}">
{{--<link rel="canonical" href="{{ url()->full() }}">--}}
@yield('page.schema')
  
<!---------------- Url Information ------------------->
<base id="baseUrl" href="{{url('')}}">
<base id="refUrl" href="{{url()->previous()}}" data-url="{{url()->previous()}}">
<base id="fullUrl" href="{{request()->fullUrl()}}">
