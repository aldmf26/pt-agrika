<x-app-layout :title="$title">
    <div class="row">
        @foreach ($menus as $menu)
            <div class="col-lg-3">
                @php
                    $linkRoute = $route;

                    if (
                        !empty($isSubLevel) ||
                        (!empty($menu->parent_id) &&
                            ($menu->parent_id == 113 || $menu->parent_id == 154 || $menu->parent_id == 169))
                    ) {
                        $linkRoute = $menu->link;
                    }

                    $linkParam = $menu->title;
                @endphp

                <a wire:navigate href="{{ route($linkRoute, $linkParam) }}">
                    <div style="cursor:pointer;" class="bg-info card border card-hover text-white">
                        <div class="card-front">
                            <div class="card-body">
                                <h5 class="card-title text-white text-center">
                                    <img src="{{ asset('img/folder.png') }}" width="80" alt=""><br><br>
                                    {{ ucfirst($menu->title) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
