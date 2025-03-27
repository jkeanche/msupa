@auth
    @if(auth()->user()->isAdmin())
        @include('partials.sidebars.admin')
    @elseif(auth()->user()->isSupermarketOwner() || auth()->user()->isVendor())
        @include('partials.sidebars.vendor')
    @else
        @include('partials.sidebars.customer')
    @endif
@endauth
