<div class="container">
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Latest Posts</h2>
            <div class="btn-right">
                <a href="/blogs" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
            </div>
        </div>
        <div class="post-grid d-flex flex-wrap justify-content-between">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            @if($blog->image == null)
                                <img src="assets/images/products/product-default-list-350.jpeg" width="100%" class="img-fluid" />
                            @else
                                <img src="public/assets/images/blogs/{{ $blog->image }}" width="100%" class="img-fluid" />
                            @endif
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date"><span class="fcp-upload3"></span> {{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                            <span class="meta-author">- <span class="fcp-account"></span> {{ $blog->author }}</span>
                        </div>
                        <h3 class="card-title">
                            <a href="/blogs/{{ $blog->id }}" class="blog-link">
                                {{ $blog->title }}
                            </a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
