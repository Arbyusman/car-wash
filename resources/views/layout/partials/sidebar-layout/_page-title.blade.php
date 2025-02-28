<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    {{-- <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-muted text-hover-primary">Home</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">Dashboards</li>
		<!--end::Item-->
	</ul> --}}

    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

        @php
            $segments = Request::segments();
            $numSegments = count($segments);
        @endphp

        @for ($i = 0; $i < $numSegments; $i++)
            @if ($i === $numSegments - 1)
                @continue
            @endif
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('/' . implode('/', array_slice($segments, 0, $i + 1))) }}"
                    class="text-muted">{{ ucfirst($segments[$i]) }}</a>
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
        @endfor
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
