<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">أضافة
                            لغة جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href="{{route('admin.maincategories')}}"><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/general.main categories')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/general.show all')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">{{__('admin/general.add main category')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">  {{__('admin/general.sub category')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">400</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.subcategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/general.show all')}} </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('admin.subcategories.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/general.add sub category')}}
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الماركات التجارية  </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brands')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brands.create')}}" data-i18n="nav.dash.crypto">أضافة
                            ماركة جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">تذاكر المراسلات   </span>
                    <span
                        class="badge badge badge-danger  badge-pill float-right mr-2">0</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce"> تذاكر الطلاب </a>
                    </li>
                </ul>
            </li>


            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                                                                                    data-i18n="nav.templates.main">{{__('admin/sidebar.settings')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{__('admin/sidebar.shipping methods')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('edit.shipping.methods','free')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.free shipping')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shipping.methods','inner')}}">{{__('admin/sidebar.local shipping')}} </a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shipping.methods','outer')}}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.outer shipping')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>






        </ul>
    </div>
</div>
