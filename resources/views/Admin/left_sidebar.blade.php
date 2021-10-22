            <div class="app-sidebar-wrapper">
                <div class="app-sidebar bg-asteroid sidebar-text-light" style="background-image:none !important;background-color: #1f3963;">
                    <div class="app-header__logo" style="background-color: white;">
                        <a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="{{ config('app.project_name') }} Admin Template" class="logo-src1">
                            <img style="width: 44px;height: 44px;" src="{{ config('app.project_logo')  }}">PPCB</a>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav" style="background-color: #ff9f9f;">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                    <div class="scrollbar-sidebar scrollbar-container">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Menu</li>
                                 <li class="mm-active">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                       Industries
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-show">           
                                        <li>
                                            <a href="{{ route('industries_list') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Industries
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                 <li class="mm-active">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                       Tenure
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-show">           
                                        <li>
                                            <a href="{{ route('tenure_list') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Tenure
                                            </a>
                                        </li>
                                       <!--  <li>
                                            <a href="{{ route('company_financial') }}">
                                                <i class="metismenu-icon pe-7s-graph1">
                                                </i>Records
                                            </a>
                                        </li> -->
                                    </ul>
                                </li>

                                <li class="mm-active">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                       Fees Calculation
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul class="mm-show">           
                                        <li>
                                            <a href="{{ route('fresh_cte_add') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Fresh CTE
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('generated_cte_list') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Generated CTE List
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('fresh_cto_add') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Fresh CTO
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('generated_cto_list') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Generated CTO List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('regulation_add') }}">
                                                <i class="metismenu-icon pe-7s-graph">
                                                </i>Regulation
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('generated_regulation_list') }}">
                                                <i class="metismenu-icon pe-7s-graph1">
                                                </i>Generated Regulation List
                                            </a>
                                        </li>

                                         <li>
                                            <a href="{{ route('reverse_calculation') }}">
                                                <i class="metismenu-icon pe-7s-graph1">
                                                </i>Reverse Calculation
                                            </a>
                                        </li>

                                    </ul>
                                </li>




                               <!--  <li class="app-sidebar__heading">Menu</li>
                                <li>
                                    <a href="{{ route('company_financial') }}">
                                        <i class="metismenu-icon pe-7s-graph2">
                                        </i>Company Financial
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-apexcharts.html">
                                        <i class="metismenu-icon pe-7s-graph">
                                        </i>Apex Charts
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-sparklines.html">
                                        <i class="metismenu-icon pe-7s-graph1">
                                        </i>Chart Sparklines
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>