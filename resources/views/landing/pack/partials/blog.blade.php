<div class="layer-stretch">
    <div class="layer-wrapper pb-3">
        <div class="layer-ttl">
            <h4>Services <span class="vert-louma">{{ ucfirst(strtolower($pro)) }}</span></h4>
        </div>
        <div class="layer-sub-ttl text-justify">{{$annexe}}</div>
        <div class="row pt-3">
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <img src="{{ asset('assets/images/gallery/'.$im1) }}" alt="">
                    <div class="pt-3">
                        <p>{{$section1}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <img src="{{ asset('assets/images/gallery/'.$im2) }}" alt="">
                    <div class="pt-3">
                        <p>{{$section2}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <img src="{{ asset('assets/images/gallery/'.$im3) }}" alt="">
                    <div class="pt-3">
                        <p>{{$section3}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
