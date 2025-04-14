<div>
    @foreach($offices as $office)
        <div class="office">

            <div>
                <i class="fa-solid fa-chevron-down"></i> {{$office->name}}
            </div>
            <div class="phone">
                <a href="viber://chat?number={{$office->phone}}">
                    <i class="fa-brands fa-viber"></i> {{$office->phone}}
                </a>
            </div>
            <div>
                <i class="fa-solid fa-location-dot"></i> {{$office->description}}
            </div>

        </div>
    @endforeach
</div>