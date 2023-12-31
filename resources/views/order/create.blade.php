<div class="button_order_create">
    <button  class="btn btn-blue" data-bs-toggle="collapse" href="#collapseOrder" role="button" aria-expanded="false" aria-controls="collapseOrder">
        @lang('order.create_order')
    </button>
</div>
<div class="collapse" id="collapseOrder">
    <h4>@lang('order.creating_order')</h4>

    <div class="user_settings">
        <form method="post" action="{{route('order.create')}}">
            @csrf
            <create-order
                :deliveries="{{json_encode($deliveries)}}"
                :payments="{{json_encode($payments)}}"
                :user="{{json_encode($user)}}"
                :validate_errors="{{$errors}}"
            ></create-order>
            <div class="mb-3 row">
                <div class="col-sm-2 note">
                    @lang('order.note'):
                </div>
                <div class="col-sm-10">
                    <textarea name="note" class="form-control">
                        {{old('note')}}
                    </textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-blue">@lang('order.save')</button>
                </div>
            </div>
        </form>
    </div>
</div>
