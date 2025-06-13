@php
    $banners = App\Models\Banner::active()
        ->where('status', true)
        ->where(function($query) {
            $query->whereNull('starts_at')
                  ->orWhere('starts_at', '<=', now());
        })
        ->where(function($query) {
            $query->whereNull('ends_at')
                  ->orWhere('ends_at', '>=', now());
        })
        ->orderBy('position')
        ->get();
@endphp

@if($banners->count() > 0)
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="swiper-container banner-slider relative">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <div class="swiper-slide">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ $banner->image }}" alt="{{ $banner->title }}" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-bold text-white">{{ $banner->title }}</h3>
                        @if($banner->link)
                        <a href="{{ $banner->link }}" class="mt-3 inline-block bg-white text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-50 transition-colors">
                            Explore Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<style>
    /* Custom styles for navigation buttons */
    .banner-slider {
        position: relative;
    }
    
    .swiper-button-prev,
    .swiper-button-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        color: #000;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s;
    }
    
    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        background-color: rgba(255, 255, 255, 0.9);
    }
    
    .swiper-button-prev {
        left: 10px;
    }
    
    .swiper-button-next {
        right: 10px;
    }
    
    /* Modify the arrow size */
    .swiper-button-prev:after,
    .swiper-button-next:after {
        font-size: 18px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.banner-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
            },
        });
    });
</script>
@endif