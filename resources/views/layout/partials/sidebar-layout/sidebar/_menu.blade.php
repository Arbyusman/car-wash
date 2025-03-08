<!--begin::sidebar menu-->
<div class="s overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
          @if (in_array(Auth::user()->role_id, [1]))

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('vehicle-types.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-car">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Tipe Kendaraan</span>
                        </a>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('vehicles.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-car-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Kendaraan</span>
                        </a>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('washers.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-people">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pekerja</span>
                        </a>
                    </div>
                </div>
            @endif
            @if (in_array(Auth::user()->role_id, [1,2]))

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('wash-transactions.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-chart-line-up ">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Transaksi</span>
                        </a>
                    </div>
                </div>
            @endif
            @if (in_array(Auth::user()->role_id, [1]))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('wash-transaction-reports.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-document">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Report</span>
                        </a>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('users.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-user">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('roles.index') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-people">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Role</span>
                        </a>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('settings.edit') }}>
                            <span class="menu-icon">
                                <i class="fs-2 ki-duotone ki-setting-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Setting</span>
                        </a>
                    </div>
                </div>
            @endif

          @if (in_array(Auth::user()->role_id, [1, 2]))

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href={{ route('logs.index') }}>
                            <span class="menu-icon"><i class="fs-2 ki-duotone ki-update-file">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Log Aplikasi</span>
                        </a>
                    </div>
                </div>
            @endif

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
