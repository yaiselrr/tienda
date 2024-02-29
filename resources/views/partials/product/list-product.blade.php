<a href="{{ route('front.product',$prod->slug) }}" class="single-product-landscape">
	<div class="img">
		<img class="lozad" data-src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
	</div>
	<div class="content">
		<p class="price">{{ $prod->showPrice() }} <small><del>{{ $prod->showPreviousPrice() }}</del></small></p>
		<ul class="stars">
			<div class="ratings">
				<div class="empty-stars"></div>
				<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
			</div>
			<li>
				<span>({{ App\Models\Rating::ratingCount($prod->id) }})</span>
			</li>
		</ul>
		<div class="box">
			<h4 class="name">
				{{ mb_strlen($prod->name,'UTF-8') > 35 ? mb_substr($prod->name,0,35,'UTF-8').'...' : $prod->name }}
			</h4>
		</div>
	</div>
</a>