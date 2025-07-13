<x-layouts>
    <x-nav.navbar.breadcrumb />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-corner-img mb-0">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Harga Wishlist</p>
                                    <h4 class="mt-1 mb-0 fw-medium">Rp.
                                        {{ number_format($wishlist->sum('total_price')) }}</h4>
                                </div>
                                <!--end col-->
                                <div class="col-3 align-self-center">
                                    <div
                                        class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                        <i class="iconoir-dollar-circle fs-22 align-self-center mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-corner-img mb-0">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Wishlist Terbeli</p>
                                    <h4 class="mt-1 mb-0 fw-medium">Rp.
                                        {{ number_format($wishlist->where('status', 'purchased')->sum('total_price')) }}
                                    </h4>
                                </div>
                                <!--end col-->
                                <div class="col-3 align-self-center">
                                    <div
                                        class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                        <i class="iconoir-dollar-circle fs-22 align-self-center mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-corner-img mb-0">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-9">
                                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Wishlist Belum Terbeli</p>
                                    <h4 class="mt-1 mb-0 fw-medium">Rp.
                                        {{ number_format($wishlist->where('status', 'wishlist')->sum('total_price')) }}
                                    </h4>
                                </div>
                                <!--end col-->
                                <div class="col-3 align-self-center">
                                    <div
                                        class="d-flex justify-content-center align-items-center thumb-md border-dashed border-primary rounded mx-auto">
                                        <i class="iconoir-dollar-circle fs-22 align-self-center mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach (\App\Models\Category::all() as $category)
                    <div class="col-md-3">
                        <div class="card my-1">
                            <div class="card-header"><small>{{ $category->name }}</small></div>
                            <div class="card-body">
                                <span>{{ $category->wishlists->count() }} Item</span><br>
                                <hr class="my-2">
                                <span>Rp. {{ number_format($category->wishlists->sum('total_price')) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts>
