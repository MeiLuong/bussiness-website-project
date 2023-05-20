@extends('backend.layout.master')

@section('title', 'Dashboard')

@section('style')
    <link href="backend/css/jquery-ui.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">--}}

    <style type="text/css">

        .tabs {
            position: relative;
            margin: 3rem 0;
            background: orange;
            height: 450px;
        }
        .tabs::before,
        .tabs::after {
            content: "";
            display: table;
        }
        .tabs::after {
            clear: both;
        }
        .tab {
            float: left;
        }
        .tab-switch {
            display: none;
        }
        .tab-label {
            position: relative;
            display: block;
            line-height: 2.75em;
            height: 3em;
            padding: 0 1.618em;
            background: orange;
            border-right: 0.125rem solid orange;
            color: #fff;
            cursor: pointer;
            top: 0;
            transition: all 0.25s;
        }
        .tab-label:hover {
            top: -0.25rem;
            transition: top 0.25s;
        }
        .tab-content {
            height: auto;
            min-height: 12rem;
            width: 100%;
            position: absolute;
            z-index: 1;
            top: 2.75em;
            left: 0;
            padding: 1.618rem 1.618rem 0;
            background: #fff;
            color: #2c3e50;
            border-bottom: 0.25rem solid #bdc3c7;
            opacity: 0;
            transition: all 0.35s;
        }
        .tab-switch:checked + .tab-label {
            background: #fff;
            color: #2c3e50;
            border-bottom: 0;
            border-right: 0.125rem solid #fff;
            transition: all 0.35s;
            z-index: 1;
            top: -0.0625rem;
        }
        .tab-switch:checked + label + .tab-content {
            z-index: 2;
            opacity: 1;
            transition: all 0.35s;
        }
    </style>
@endsection

@section('script')
{{--    <script src="backend/js/jquery-ui.js"></script>--}}
{{--    <script src="backend/js/jquery-3.6.0.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

@endsection

@section('body')

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 col-lg-4">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold"><span>{{ $countUser }}</span> <span class="icon fcp-user2" style="font-size: 1.5rem;"></span></div>
                        <div>Customers</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-12 col-lg-4">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $countOrder }} <span style="font-size: 1.5rem;" class="icon fcp-basket"></span></div>
                        <div>Orders</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-12 col-lg-4">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">${{ $sumOrder }} <span style="font-size: 1.5rem;" class="icon fcp-box-add"></span></div>
                        <div>Income</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4" style="--cui-card-cap-bg: #3b5998">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <svg class="icon icon-3xl text-white my-4">
                        <use xlink:href="node_modules/@coreui/icons/sprites/brand.svg#cib-facebook-f"></use>
                    </svg>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-1" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countProduct }}</div>
                        <div class="text-uppercase text-medium-emphasis small">products</div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countReview }}</div>
                        <div class="text-uppercase text-medium-emphasis small">reviews</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4" style="--cui-card-cap-bg: #00aced">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <svg class="icon icon-3xl text-white my-4">
                        <use xlink:href="node_modules/@coreui/icons/sprites/brand.svg#cib-twitter"></use>
                    </svg>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-2" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countCategory }}</div>
                        <div class="text-uppercase text-medium-emphasis small">categories</div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countBrand }}</div>
                        <div class="text-uppercase text-medium-emphasis small">brands</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-4">
            <div class="card mb-4" style="--cui-card-cap-bg: #4875b4">
                <div class="card-header position-relative d-flex justify-content-center align-items-center">
                    <svg class="icon icon-3xl text-white my-4">
                        <use xlink:href="node_modules/@coreui/icons/sprites/brand.svg#cib-linkedin"></use>
                    </svg>
                    <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <canvas id="social-box-chart-3" height="90"></canvas>
                    </div>
                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countBlog }}</div>
                        <div class="text-uppercase text-medium-emphasis small">blogs</div>
                    </div>
                    <div class="vr"></div>
                    <div class="col">
                        <div class="fs-5 fw-semibold">{{ $countPage }}</div>
                        <div class="text-uppercase text-medium-emphasis small">pages</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>

{{--    row--}}
    <div class="row">
        <div class="col-md-12">
            <form autocomplete="off">
                @csrf

                <div class="col-md-3">
                    <p>From: <input type="text" id="datepicker" class="form-control"></p>
                </div>
                <div class="col-md-3">
                    <label>To:</label>
                    <input type="text" id="datepicker2" class="form-control"/>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-secondary" value="Filter"/>
                </div>
            </form>
        </div>
        <div class="row col-md-12" style="display: flex">
            <div style="height: 250px;">
                <canvas id="myChart" style="margin-right: 0"></canvas>
            </div>
            <div class="col-md-6">
                <div class="tabs">
                    <div class="tab">
                        <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                        <label for="tab-1" class="tab-label">Day</label>
                        <div class="tab-content">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="label">Estimated Revenue:</h4>
                                        <strong class="value">RM
                                            @if(empty($productQtyDay->revenue))
                                                0
                                            @else
                                                {{ $productQtyDay->revenue }}
                                            @endif

                                        </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="label">Order:</h4>
                                        <p class="value">{{ $countOrderDay }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table border mb-0">
                                        <thead class="table-light fw-semibold">
                                        <tr class="align-middle">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th class="text-center">Sell number</th>
                                            <th class="text-center">Qty Remaining</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 0;
                                        ?>
                                        @if(count($bestSellerDays) == 0)
                                            <tr class="text-center">
                                                <td colspan="5">
                                                    No data.
                                                </td>
                                            </tr>
                                        @else
                                            @foreach($bestSellerDays as $bestSellerDay)
                                                    <?php
                                                    $no++
                                                    ?>
                                                <tr class="align-middle">
                                                    <td>
                                                            <?= $no ?>
                                                    </td>
                                                    <td>
                                                        {{ $bestSellerDay->product_name }}
                                                    </td>
                                                    <td>
                                                        RM{{ $bestSellerDay->product_price }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $bestSellerDay->total }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $bestSellerDay->qty_remain }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab">
                        <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
                        <label for="tab-2" class="tab-label">Week</label>
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="label">Estimated Revenue:</h4>
                                    <strong class="value">RM
                                        @if(empty($productQtyWeek->revenue))
                                            0
                                        @else
                                            {{ $productQtyWeek->revenue }}
                                        @endif

                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="label">Order:</h4>
                                    <p class="value">{{ $countOrderWeek }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                    <tr class="align-middle">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th class="text-center">Sell number</th>
                                        <th class="text-center">Qty Remaining</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 0;
                                    ?>
                                    @if(count($bestSellerWeeks) == 0)
                                        <tr class="text-center">
                                            <td colspan="5">
                                                No data.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($bestSellerWeeks as $bestSellerWeek)
                                                <?php
                                                $no++
                                                ?>
                                            <tr class="align-middle">
                                                <td>
                                                        <?= $no ?>
                                                </td>
                                                <td>
                                                    {{ $bestSellerWeek->product_name }}
                                                </td>
                                                <td>
                                                    RM{{ $bestSellerWeek->product_price }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $bestSellerWeek->total }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $bestSellerWeek->qty_remain }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <input type="radio" name="css-tabs" id="tab-3" class="tab-switch">
                        <label for="tab-3" class="tab-label">Month</label>
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="label">Estimated Revenue:</h4>
                                    <strong class="value">RM
                                        @if(empty($productQtyMonth->revenue))
                                            0
                                        @else
                                            {{ $productQtyMonth->revenue }}
                                        @endif

                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="label">Order:</h4>
                                    <p class="value">{{ $countOrderMonth }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                    <tr class="align-middle">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th class="text-center">Sell number</th>
                                        <th class="text-center">Qty Remaining</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 0;
                                    ?>
                                    @if(count($bestSellerMonths) == 0)
                                        <tr class="text-center">
                                            <td colspan="5">
                                                No data.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($bestSellerMonths as $bestSellerMonth)
                                                <?php
                                                $no++
                                                ?>
                                            <tr class="align-middle">
                                                <td>
                                                        <?= $no ?>
                                                </td>
                                                <td>
                                                    {{ $bestSellerMonth->product_name }}
                                                </td>
                                                <td>
                                                    RM{{ $bestSellerMonth->product_price }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $bestSellerMonth->total }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $bestSellerMonth->qty_remain }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab">
                        <input type="radio" name="css-tabs" id="tab-4" class="tab-switch">
                        <label for="tab-4" class="tab-label">Year</label>
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="label">Estimated Revenue:</h4>
                                    <strong class="value">RM
                                        @if(empty($productQtyYear->revenue))
                                            0
                                        @else
                                            {{ $productQtyYear->revenue }}
                                        @endif

                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="label">Order:</h4>
                                    <p class="value">{{ $countOrderYear }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                    <tr class="align-middle">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th class="text-center">Sell number</th>
                                        <th class="text-center">Qty Remaining</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 0;
                                    ?>

                                    @if(count($bestSellerYears) == 0)
                                        <tr class="text-center">
                                            <td colspan="5">
                                                No data.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($bestSellerYears as $bestSellerYear)
                                                <?php
                                                $no++
                                                ?>
                                            <tr class="align-middle">
                                                <td>
                                                        <?= $no ?>
                                                </td>
                                                <td>
                                                    {{ $bestSellerYear->product_name }}
                                                </td>
                                                <td>
                                                    RM{{ $bestSellerYear->product_price }}
                                                </td>

                                                <td class="text-center">
                                                    {{ $bestSellerYear->total }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $bestSellerYear->qty_remain }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    end row--}}

    <!-- /.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4" style="margin-top: 30px">
                <div class="table-responsive">
                    <h1>Best Sellers</h1>
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th class="text-center">Sell number</th>
                            <th class="text-center">Qty remaining</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 0;
                        ?>
                        @foreach($bestSellers as $bestSeller)
                                <?php
                                $no++
                                ?>
                            <tr class="align-middle">
                                <td>
                                        <?= $no ?>
                                </td>
                                <td>
                                    {{ $bestSeller->product_name }}
                                </td>
                                <td>
                                    RM{{ $bestSeller->product_price }}
                                </td>

                                <td class="text-center">
                                    {{ $bestSeller->total }}
                                </td>
                                <td class="text-center">
                                    {{ $bestSeller->qty_remaining }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->

    <!-- /.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4" style="margin-top: 30px">
                <div class="table-responsive">
                    <h1>New Customers</h1>
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th>No</th>
                            <th>User</th>
                            <th class="text-center">Address</th>
                            <th>Activity</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 0;
                        ?>
                        @foreach($newCustomers as $newCustomer)
                            <?php
                                $no++
                                ?>
                            <tr class="align-middle">
                                <td>
                                    <?= $no ?>
                                </td>
                                <td>
                                    <div>{{ $newCustomer->name }}</div>
                                    <div class="small text-medium-emphasis"><span>New</span> | Registered: {{ date('M d, Y', strtotime($newCustomer->created_at)) }}</div>
                                </td>
                                <td class="text-center">
                                    {{ $newCustomer->address }}
                                </td>

                                <td>
                                    <div class="small text-medium-emphasis">Last login</div>
                                    <div class="fw-semibold">10 sec ago</div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="icon">
                                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->

@endsection
