@props(['links'])

<div class="sidebar">

    <div class="sidebar-inner">

        @foreach ($links as $menu)

            <div class="menu">

                {{-- LOGOUT --}}
                @if ($menu['label'] === 'Logout')

                    <form action="{{ $menu['link'] }}"
                          method="POST"
                          class="w-100">

                        @csrf

                        <button type="submit"
                                class="sidebar-btn">

                            <i class="{{ $menu['icon'] }}"></i>

                            <span>
                                {{ $menu['label'] }}
                            </span>

                        </button>

                    </form>

                @else

                    {{-- NORMAL LINK --}}
                    <a href="{{ $menu['link'] }}"
                       class="sidebar-link">

                        <i class="{{ $menu['icon'] }}"></i>

                        <span>
                            {{ $menu['label'] }}
                        </span>

                    </a>

                @endif

            </div>

        @endforeach

    </div>

</div>