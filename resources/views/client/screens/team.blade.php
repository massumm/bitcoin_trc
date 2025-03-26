<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title id="medishop_title">
       Coin Bit
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <!-- Custom Styles -->
    <style>
        body {
            padding-bottom: 60px; /* Space for bottom navigation */
        }
        .back-btn {
            position: absolute;
            left: 15px;
            font-size: 18px;
            text-decoration: none;
            color: black;
        }
        .back-btn i {
            font-size: 20px;
        }

    </style>
</head>

<body>
<div class="container">
<a href="javascript:void(0);" class="back-btn" id="backButton">
            <i class="fas fa-arrow-left"></i>
        </a>
<div class="top-section"></div>

<!-- Team Amount Section -->
<div class="container text-center">
    <h3 class="text-white mb-2">Team Amount</h3>
    <h2 class="text-white display-4 mb-4">{{ number_format($stats['team_amount'], 2) }}</h2>

    <!-- Stats Cards -->
    <div class="info-card">
        <div class="row">
            <div class="col-4">
                <small>Agent Profit</small>
                <div class="text-white">{{ number_format($stats['agent_profit'], 2) }}</div>
            </div>
            <div class="col-4">
                <small>Total Recharge</small>
                <div class="text-white">{{ number_format($stats['total_recharge'], 2) }}</div>
            </div>
            <div class="col-4">
                <small>Total Withdraw</small>
                <div class="text-white">{{ number_format($stats['total_withdraw'], 2) }}</div>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="row">
            <div class="col-4">
                <small>Order Commission</small>
                <div class="text-white">{{ number_format($stats['order_commission'], 2) }}</div>
            </div>
            <div class="col-4">
                <small>Newcomers</small>
                <div class="text-white">{{ $stats['newcomers'] }}</div>
            </div>
            <div class="col-4">
                <small>Activities Number</small>
                <div class="text-white">{{ $stats['activities_number'] }}</div>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="row">
            <div class="col-6">
                <small>Team Amount</small>
                <div class="text-white">{{ number_format($stats['team_amount'], 2) }}</div>
            </div>
            <div class="col-6">
                <small>Team Number</small>
                <div class="text-white">{{ $stats['team_number'] }}</div>
            </div>
        </div>
    </div>

    <!-- Level Tabs -->
    <div class="card w-100 mt-4" style="max-width: 450px;">
        <div class="card-body">
            <ul class="nav nav-tabs d-flex justify-content-between" id="levelTabs" role="tablist">
                <li class="nav-item flex-grow-1 text-center" role="presentation">
                    <button class="nav-link active w-100" id="level1-tab" data-bs-toggle="tab" data-bs-target="#level1" type="button" role="tab">Level 1</button>
                </li>
                <li class="nav-item flex-grow-1 text-center" role="presentation">
                    <button class="nav-link w-100" id="level2-tab" data-bs-toggle="tab" data-bs-target="#level2" type="button" role="tab">Level 2</button>
                </li>
                <li class="nav-item flex-grow-1 text-center" role="presentation">
                    <button class="nav-link w-100" id="level3-tab" data-bs-toggle="tab" data-bs-target="#level3" type="button" role="tab">Level 3</button>
                </li>
            </ul>
            <div class="tab-content" id="levelTabsContent">
                <div class="tab-pane fade show active" id="level1" role="tabpanel">
                    @if(count($teamData['level1']) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Balance</th>
                                        <th>Total Deposit</th>
                                        <th>Joined Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamData['level1'] as $member)
                                    <tr>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ number_format($member['balance'], 2) }}</td>
                                        <td>{{ number_format($member['total_deposit'], 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($member['joined_date'])->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">No data</div>
                    @endif
                </div>
                <div class="tab-pane fade" id="level2" role="tabpanel">
                    @if(count($teamData['level2']) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Balance</th>
                                        <th>Total Deposit</th>
                                        <th>Joined Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamData['level2'] as $member)
                                    <tr>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ number_format($member['balance'], 2) }}</td>
                                        <td>{{ number_format($member['total_deposit'], 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($member['joined_date'])->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">No data</div>
                    @endif
                </div>
                <div class="tab-pane fade" id="level3" role="tabpanel">
                    @if(count($teamData['level3']) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Balance</th>
                                        <th>Total Deposit</th>
                                        <th>Joined Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamData['level3'] as $member)
                                    <tr>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ number_format($member['balance'], 2) }}</td>
                                        <td>{{ number_format($member['total_deposit'], 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($member['joined_date'])->format('Y-m-d') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">No data</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<style>
.container {
    max-width: 100%;
}

.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.info-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    width: 100%;
    max-width: 350px;
}

.info-card .row {
    display: flex;
    justify-content: space-between;
}

.top-section {
    background: linear-gradient(to right, #4A90E2, #2563eb);
    height: 450px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.nav-tabs {
    border-bottom: none;
}

.nav-tabs .nav-link {
    color: #333;
    border: none;
    font-weight: 500;
    background: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

.nav-tabs .nav-link.active {
    color: white;
    background: #4e73df;
    border-bottom: 2px solid #4e73df;
}

.display-4 {
    font-weight: 600;
}

small {
    display: block;
    margin-bottom: 5px;
    color: white;
    opacity: 0.8;
}
</style>

