@php
    $currentRoute = request()->route()->getName();
    $pageTitle = 'Dashboard';
    $breadcrumbs = [['label' => 'Home', 'url' => route('dashboard')]];

    if ($currentRoute === 'category.index') {
        $pageTitle = 'Kategori';
        $breadcrumbs[] = ['label' => 'Master Data', 'url' => '#'];
        $breadcrumbs[] = ['label' => 'Kategori', 'url' => null];
    } else {
        $breadcrumbs[] = ['label' => 'Dashboard', 'url' => null];
    }
@endphp

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">{{ $pageTitle }}</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($breadcrumb['url'])
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
