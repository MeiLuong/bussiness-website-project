<div class="tabset">
    <!-- Tab 1 -->
    <input type="radio" name="tabset" id="tab1" aria-controls="description" checked>
    <label for="tab1">Description</label>
    <!-- Tab 2 -->
    <input type="radio" name="tabset" id="tab2" aria-controls="review">
    <label for="tab2">Review</label>

    <div class="tab-panels">
        <section id="description" class="tab-panel">
            {!! $product->product_description !!}
        </section>
        <section id="review" class="tab-panel">
            <div class="block-title">
                @if(count($product->productReviews) > 1)
                    <h4 class="title">
                        {{ count($product->productReviews) }} reviews
                    </h4>
                @endif

            </div>
            <div class="block-content review-items">
                @if(count($product->productReviews) > 0)
                    <div class="block-title">
                        <h4 class="title">
                            Review
                        </h4>
                    </div>
                @endif
                @foreach($product->productReviews as $productReview)
                    <div class="review-item">
                        <div class="rating-result-wrapper">
                            <div class="ratings">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $productReview->rating)
                                        <span class="star fcp-star-full"></span>
                                    @else
                                        <span class="star fcp-star-empty"></span>
                                    @endif

                                @endfor
                            </div>
                            <div class="rating-message">
                                {{ $productReview->message }}
                            </div>
                        </div>

                        <div class="rating-info-wrapper">
                            <div class="rating-person">
                                <strong class="label">Review by </strong>
                                <span class="value">{{ $productReview->name }}</span>
                            </div>
                            <div class="rating-date">
                                <strong class="label">Posted on </strong>
                                <span class="value">{{ date('M d, Y', strtotime($productReview->created_at)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <h4 class="block-title">You Are Reviewing: {{ $product->product_name }}</h4>
                    <form action="" method="post" id="review_form" class="review-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}"/>

                        <fieldset style="max-width: 200px">
                            <label>Your rating: </label>
                            <div id="rating_group" class="rating-group">
                                <input type="radio" id="start5" name="rating" value="5" />
                                <label for="start5" title="text ">5 stars</label>
                                <input type="radio" id="start4" name="rating" value="4" />
                                <label for="start4" title="text ">4 stars</label>
                                <input type="radio" id="start3" name="rating" value="3" />
                                <label for="start3" title="text ">3 stars</label>
                                <input type="radio" id="start2" name="rating" value="2" />
                                <label for="start2" title="text ">2 stars</label>
                                <input type="radio" id="start1" name="rating" value="1" />
                                <label for="start1" title="text ">1 stars</label>
                            </div>
                        </fieldset>

                        <fieldset>
                            <label class="label">Name<span class="required">*</span></label>
                            <input type="text" placeholder="Name" name="name"/>
                        </fieldset>

                        <fieldset>
                            <label class="label">Email<span class="required">*</span></label>
                            <input type="text" placeholder="Email" name="email"/>
                        </fieldset>

                        <fieldset>
                            <label class="label">Review<span class="required">*</span></label>
                            <textarea name="message"></textarea>
                        </fieldset>

                        <div class="actions">
                            <button type="submit" class="btn btn-primary submit-review">Submit Review</button>
                        </div>

                    </form>
                </div>

            </div>
        </section>

    </div>

</div>

