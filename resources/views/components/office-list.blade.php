<div>
    @foreach($offices as $office)
        <div class="office">

            <div>
                <i class="fa-solid fa-chevron-down"></i> {{$office->name}}
            </div>
            <div class="phone">
                <a href="tel:{{cleanPhoneUrl($office->phone)}}">
                    <i class="fa-solid fa-phone"></i> {{$office->phone}}
                </a>
            </div>
            <div class="phone">
                <a href="viber://chat?number={{cleanPhoneUrl($office->phone)}}">
                    <i class="fa-brands fa-viber"></i> {{$office->phone}}
                </a>
            </div>
            <div>
                <a href="{{route('page', 'contacts').'#office_'.$office->id}}">
                    <i class="fa-solid fa-location-dot"></i> {{$office->description}}
                </a>
            </div>

        </div>
    @endforeach
</div>