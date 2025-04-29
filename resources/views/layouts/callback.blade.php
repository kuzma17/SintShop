
<div class="" style="padding: 10px; height: 210px; border: 1px solid #cccccc; border-radius: 10px; margin-bottom: 20px; background-color: whitesmoke">

    <div style="color: #0DA6DD; font-size: 18px; font-weight: bolder;"><i class="fa-solid fa-phone"></i> @lang('main.callback')</div>
        <form name="callback" method="post" action="{{route('callback')}}">
            @csrf
            <div class="mb-3 mt-3">
                <input type="text" class="form-control" placeholder="@lang('main.your_name')" name="name" required>
            </div>
            <div class="mb-3">
                <input-phone
                        name="phone"
                        placeholder="@lang('main.your_phone')"
                        required="required"
                ></input-phone>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-blue" style="float: right">@lang('main.send')</button>
            </div>
        </form>

</div>
