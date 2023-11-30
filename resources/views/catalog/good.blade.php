@extends('layouts.page')

@section('link'){{Breadcrumbs::render('good', $good)}}@endsection
@section('body')
        <div class="good">
            <div class="row">
                <div class="col-12 col-md-6">
                    @if($good->photos && count($good->photos) > 0)
                        <photos-gallery
                            :patch="{{json_encode('/images/goods/')}}"
                            :photos="{{json_encode($good->photos)}}"
                        >
                        </photos-gallery>
                    @else
                        <img src="/images/no_photo.jpg">
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <div class="good-set">
                        <div class="title">
                            <h4>{{$good->title}}</h4>
                        </div>
                        <div class="code">
                            <span class="title-sm">@lang('catalog.code_good'):</span> {{$good->code}}
                        </div>
                        <x-existence
                            :good=$good
                        ></x-existence>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <div class="price">
                                    {{$good->price}} грн.
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="button">
                                    <x-button-add-cart
                                        :good=$good
                                    ></x-button-add-cart>
                                </div>
                            </div>
                        </div>
                        <div class="delivery">
                           <div class="title-sm"><i class="fa-solid fa-truck-arrow-right"></i> @lang('catalog.delivery'):</div>
                            <ul>
                                <li>@lang('catalog.pickup')</li>
                                <li>@lang('catalog.delivery_address')</li>
                                <li><a href="">@lang('catalog.more')</a> </li>
                            </ul>
                        </div>
                        <div class="payment">
                            <div class="title-sm"><i class="fa-regular fa-money-bill-1"></i> @lang('catalog.payment'):</div>
                            <ul>
                                <li>@lang('catalog.cash')</li>
                                <li>@lang('catalog.cashless')</li>
                                <li>@lang('catalog.on_cart')</li>
                                <li><a href="">@lang('catalog.more')</a> </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="good_settings">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <h5>@lang('catalog.description')</h5>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <h5>@lang('catalog.settings')</h5>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <h5>@lang('catalog.video')</h5>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="home-tab">
                        {!! $good->description !!}
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-striped">
                            @foreach($good->getListValuesAttribure() as $list)
                                <tr>
                                    <td>{{$list['attribute']}}</td>
                                    <td>
                                        {{$list['values']}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="profile-tab" style="text-align: center">
                       @if(isset($good->videos) && count($good->videos) > 0)
                            @foreach($good->videos as $video)
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video->youtube}}"></iframe>
                            @endforeach
                       @endif
                    </div>
                </div>
            </div>


        </div>
@endsection
