@php

    /*
    $text_rev = DB::table('text_reviews as c1')
        ->whereIn('c1.course_id', [5, 7, 8, 11, 10])
        ->where('c1.status', '1')
        ->select('c1.course_id', 'c1.thumbnail', 'c1.name', 'c1.description', 'c1.profile','c1.url','c1.type', 'c1.created_at as latest_created_at')
        ->join(DB::raw('(SELECT course_id, MAX(created_at) as max_created_at
                        FROM text_reviews
                        WHERE course_id IN (5, 7, 8, 11, 10) AND status = \'1\'
                        GROUP BY course_id) as c2'), function ($join) {
                            $join->on('c1.course_id', '=', 'c2.course_id')
                                ->on('c1.created_at', '=', 'c2.max_created_at');
                        })
        ->orderBy('c1.created_at', 'ASC')
        ->get();
    */

    /*
    $text_rev = DB::table('text_reviews as c1')
        ->whereIn('c1.course_id', [5, 7, 8, 11, 10])
        ->where('c1.status', '1')
        ->select('c1.course_id', 'c1.thumbnail', 'c1.name', 'c1.description', 'c1.profile', 'c1.url', 'c1.type', 'c1.created_at as latest_created_at')
        ->join(DB::raw('(SELECT id, course_id, thumbnail, name, description, profile, url, type, created_at
                        FROM (
                            SELECT id, course_id, thumbnail, name, description, profile, url, type, created_at,
                                ROW_NUMBER() OVER (PARTITION BY course_id ORDER BY created_at ASC) AS row_num
                            FROM text_reviews
                            WHERE course_id IN (5, 7, 8, 11, 10) AND status = \'1\' AND type IN (\'google\', \'google_mcse\')
                        ) AS ranked_reviews
                        WHERE row_num <= 2) as c2'), function ($join) {
                            $join->on('c1.id', '=', 'c2.id');
                        })
        ->orderBy('c1.created_at', 'ASC')
        ->get();
    */

    $text_rev = DB::table('text_reviews as c1')
        ->whereIn('c1.course_id', [5, 7, 8, 11, 10])
        ->where('c1.status', '1')
        ->select('c1.id','c1.course_id', 'c1.thumbnail', 'c1.name', 'c1.description', 'c1.profile', 'c1.url', 'c1.type', 'c1.created_at as latest_created_at')
        ->where(function ($query) {
            $query->whereRaw('(SELECT COUNT(*) FROM text_reviews as c2 WHERE c2.course_id = c1.course_id AND c2.created_at >= c1.created_at) <= 2');
        })
        ->orderBy('c1.course_id')
        ->orderByDesc('c1.created_at')
        ->get();
    
@endphp


<div class="large-12 columns mt-4">
    <div class="owl-carousel owl-theme slider_content_dots">

        @foreach ($text_rev as $row)
            <div class="item">
                <div class="testimonial_box">
                    <div class="testimonial__header">
                        <div class="row">
                            <div class="col-lg-9 col-10">
                                <div class="testimonial__image"> <img
                                        data-src="{{ asset('storage/' . $row->thumbnail) }}"
                                        class="lazyload d-block w-100" alt="unnamed"> <span
                                        class="testimonial__name">{{ $row->name }}</span> 
                                </div>
                                <span>{{ $row->profile }}</span>
                            </div>
                            <div class="col-lg-3 col-2">
                                <div class="testimonial__icon"> 
                                    @if($row->type == 'google' || $row->type == 'google_mcse')
                                        <a aria-label="Google Reviews by {{ $row->name }}" href="{{ $row->url }}&id={{ $row->id }}"><i aria-hidden="true" class="fab fa-google-plus"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial__content">
                        <div class="testimonial__text">
                            @php echo html_entity_decode($row->description) @endphp
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
