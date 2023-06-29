@extends('layouts.app')

@section('content')
    <div class="img-title">
        <img src="{{ Vite::asset('resources/images/laptop-in-modern-office 1.png') }}" alt="">
    </div>
    <div class="list-blog">
        <div class="title">
            <h1>{{ __('blog.title_list_blog') }}</h1>
            <select type="text" name="category_id" class="select-category item-input">
                <option value="0">{{ __('blog.title_select_category')}}</option>
                @foreach ($categories as $item)
                    <option value="{{ route('blogs.category', ['id' => $item['id']]) }}"
                        @if ($request->has('id') && $request->id == $item['id']) selected @endif
                    >
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if ($blogs->count() == 0)
            <h2>{{ __('blog.text_no_found_blog') }}</h2>
        @else
            <div class="all-item">
                @foreach($blogs as $item)
                    <div class="item-blog">
                        <div class="item-blog-img">
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="">
                        </div>
                        <div class="item-blog-content">
                            <div class="info">
                                <div class="author">
                                    <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                    <p>{{ $item['user']['user_name'] }}</p>
                                </div>
                                <div class="time">
                                    <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                    @php
                                        $timeMinutes = now()->diffInMinutes($item['created_at'], true);
                                        if ($timeMinutes > 43200) {
                                            $timeMinutes = (int)($timeMinutes/43200)." months ago";
                                        }
                                        elseif ($timeMinutes > 10080) {
                                            $timeMinutes = (int)($timeMinutes/10080)." weeks ago";
                                        }
                                        elseif ($timeMinutes > 1440) {
                                            $timeMinutes = (int)($timeMinutes/1440)." days ago";
                                        }
                                        elseif ($timeMinutes > 60) {
                                            $timeMinutes = (int)($timeMinutes/60)." hours ago";
                                        }
                                        else {
                                            $timeMinutes = $timeMinutes." minutes ago";
                                        }
                                    @endphp
                                    <p>{{ $timeMinutes }}</p>
                                </div>
                            </div>
                            <div class="text-detail">
                                @php
                                    $lengthContent = strlen($item['content']);
                                    if ($lengthContent > 150) {
                                        $content = substr($item['content'], 0, 150).'.....';
                                    } else {
                                        $content = $item['content'];
                                    }
                                @endphp
                                <p>{{ $item['title'] }}</p>
                                <p>{!! $content !!}</p>
                            </div>
                            <div class="text-link">
                                <button class="btn btn-details">
                                    <a href="{{ route('blog.detail', ['id' => $item['id']]) }}">{{ __('blog.btn_detail_blog') }}</a> 
                                    <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('layouts.paginate')
        @endif
    </div>
@endsection
