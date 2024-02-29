<div class="col-lg-3">
  
        {{-- RATING SECTION --}}

        <div class="review-and-rating-area">
          <div id="rating-load">
            <div class="left">
              <h4 class="rate">{{ App\Models\Rating::normalRating($productt->id) }}</h4>
              <ul class="stars">
                  <div class="ratings">
                      <div class="empty-stars big"></div>
                      <div class="full-stars big" style="width:{{ App\Models\Rating::ratings($productt->id) }}%"></div>
                  </div>
              </ul>
              <p class="total-review">{{ App\Models\Rating::ratingCount($productt->id) }} {{ __('Review') }}</p>
            </div>
            <div class="right">
              <ul class="reating-poll">
                <li>
                  <div class="star-list">
                    <ul class="star-list stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:100%"></div>
                        </div>
                    </ul>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ App\Models\Rating::customRatings($productt->id,5) }}%" aria-valuenow="{{ App\Models\Rating::customRatings($productt->id,5) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="count">{{ App\Models\Rating::customRatingsCount($productt->id,5) }}</span>
                </li>
                <li>
                  <div class="star-list">
                    <ul class="star-list stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:80%"></div>
                        </div>
                    </ul>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ App\Models\Rating::customRatings($productt->id,4) }}%" aria-valuenow="{{ App\Models\Rating::customRatings($productt->id,4) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="count">{{ App\Models\Rating::customRatingsCount($productt->id,4) }}</span>
                </li>
                <li>
                  <div class="star-list">
                    <ul class="star-list stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:60%"></div>
                        </div>
                    </ul>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ App\Models\Rating::customRatings($productt->id,3) }}%" aria-valuenow="{{ App\Models\Rating::customRatings($productt->id,3) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="count">{{ App\Models\Rating::customRatingsCount($productt->id,3) }}</span>
                </li>
                <li>
                  <div class="star-list">
                    <ul class="star-list stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:40%"></div>
                        </div>
                    </ul>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ App\Models\Rating::customRatings($productt->id,2) }}%" aria-valuenow="{{ App\Models\Rating::customRatings($productt->id,2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="count">{{ App\Models\Rating::customRatingsCount($productt->id,2) }}</span>
                </li>
                <li>
                  <div class="star-list">
                    <ul class="star-list stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:20%"></div>
                        </div>
                    </ul>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ App\Models\Rating::customRatings($productt->id,1) }}%" aria-valuenow="{{ App\Models\Rating::customRatings($productt->id,1) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="count">{{ App\Models\Rating::customRatingsCount($productt->id,1) }}</span>
                </li>
              </ul>
            </div>
        </div>
      </div>

      {{-- RATING SECTION ENDS --}}

        {{-- PRODUCT WHOLE SELL SECTION --}}

        @if(!empty($productt->whole_sell_qty))
          <div class="wholesell-table">
            <h4 class="title">{{ __('Wholesell') }}</h4>
            <table class="table">
              <thead>
                <tr>
                  <th>{{ __('Quantity') }}</th>
                  <th>{{ __('Discount') }}</th>
                </tr>
              </thead>
              <tbody>

                @foreach($productt->whole_sell_qty as $key => $data1)
                <tr>
                  <td>{{ $productt->whole_sell_qty[$key] }}+</td>
                  <td>{{ $productt->whole_sell_discount[$key] }}% {{ __('Off') }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        @endif
        {{-- PRODUCT WHOLE SELL SECTION ENS --}}
      </div>