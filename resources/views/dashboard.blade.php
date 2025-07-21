<x-app-layout :title="$title">
    @php

    @endphp
    <div class="row">
        @foreach ($datas as $d => $i)
            @php
                $cekParent = !empty($i->parent_id) && $i->parent_id == 113;
            @endphp
            <div class="col-lg-3">
                <a href="{{ route($cekParent ? $i->link : $route, $i->title) }}">
                    <div style="cursor:pointer;" class="bg-info card border card-hover text-white">
                        <div class="card-front">
                            <div class="card-body">
                                <h5 class="card-title text-white text-center">
                                    <img src="{{ asset('img/folder.png') }}" width="80" alt=""><br><br>
                                    {{ ucfirst($i->title) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
</x-app-layout>
