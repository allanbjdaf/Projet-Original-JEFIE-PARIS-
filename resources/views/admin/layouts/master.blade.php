{{-- resources/views/admin/layouts/master.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Admin') — JEFIE Paris 2026</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f7;
            color: #1a2744;
        }

        /* ── LAYOUT ── */
        .admin-layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        /* ══ SIDEBAR ══ */
        .sb {
            background: #0f284e;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .1) transparent;
        }

        .sb::-webkit-scrollbar {
            width: 4px;
        }

        .sb::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .12);
            border-radius: 2px;
        }

        /* Brand */
        .sb-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sb-brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(245, 166, 35, .15);
            border: 1.5px solid rgba(245, 166, 35, .4);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sb-brand-icon svg {
            width: 20px;
            height: 20px;
            stroke: #f5c518;
            fill: none;
            stroke-width: 1.8;
        }

        .sb-brand-title {
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.2;
        }

        .sb-brand-sub {
            color: rgba(255, 255, 255, .4);
            font-size: 10px;
            margin-top: 1px;
        }

        /* User info */
        .sb-user {
            padding: .85rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sb-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(245, 166, 35, .2);
            border: 2px solid rgba(245, 166, 35, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f5c518;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sb-user-name {
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
        }

        .sb-user-role {
            color: rgba(255, 255, 255, .4);
            font-size: 10px;
        }

        .sb-user-dot {
            width: 7px;
            height: 7px;
            background: #43a047;
            border-radius: 50%;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Nav items */
        .sb-section {
            padding: .75rem 1.5rem .3rem;
            font-size: 9px;
            font-weight: 800;
            color: rgba(255, 255, 255, .28);
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .sb-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 1.5rem;
            font-size: 12px;
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all .15s;
            position: relative;
            cursor: pointer;
        }

        .sb-item:hover {
            background: rgba(255, 255, 255, .05);
            color: #fff;
            border-left-color: rgba(255, 255, 255, .2);
        }

        .sb-item.active {
            background: rgba(245, 166, 35, .1);
            color: #f5c518;
            border-left-color: #f5c518;
            font-weight: 700;
        }

        .sb-item svg {
            width: 15px;
            height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            flex-shrink: 0;
        }

        .sb-num {
            margin-left: auto;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 10px;
            min-width: 20px;
            text-align: center;
        }

        .sb-num.red {
            background: #e53935;
            color: #fff;
        }

        .sb-num.green {
            background: #2e7d32;
            color: #fff;
        }

        .sb-num.blue {
            background: #0f284e;
            color: #fff;
        }

        .sb-num.grey {
            background: rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .6);
        }

        /* Bottom */
        .sb-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, .07);
            padding: .75rem 0;
        }

        .sb-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 1.5rem;
            font-size: 12px;
            color: rgba(255, 255, 255, .4);
            text-decoration: none;
            transition: all .2s;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
            font-family: inherit;
        }

        .sb-logout:hover {
            color: #e53935;
            background: rgba(229, 57, 53, .06);
        }

        .sb-logout svg {
            width: 15px;
            height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
        }

        /* ══ MAIN ══ */
        .admin-main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #718096;
        }

        .topbar-breadcrumb a {
            color: #718096;
            text-decoration: none;
            transition: color .2s;
        }

        .topbar-breadcrumb a:hover {
            color: #0f284e;
        }

        .topbar-breadcrumb span {
            font-size: 11px;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 800;
            color: #0f284e;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-notif {
            width: 36px;
            height: 36px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #fff;
            position: relative;
            transition: background .2s;
        }

        .topbar-notif:hover {
            background: #f4f6fa;
        }

        .topbar-notif svg {
            width: 16px;
            height: 16px;
            stroke: #718096;
            fill: none;
            stroke-width: 1.8;
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 7px;
            height: 7px;
            background: #e53935;
            border-radius: 50%;
            border: 1.5px solid #fff;
        }

        .btn-site {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f4f6fa;
            border: 1px solid #e2e8f0;
            color: #0a1e38;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 7px;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-site:hover {
            background: #0f284e;
            color: #fff;
            border-color: #0f284e;
        }

        .btn-site svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .btn-export-top {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #0f284e;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background .2s;
            font-family: inherit;
        }

        .btn-export-top:hover {
            background: #0a1e38;
        }

        .btn-export-top svg {
            width: 13px;
            height: 13px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        /* Content */
        .admin-content {
            padding: 1.75rem 2rem;
            flex: 1;
        }

        /* ── COMPOSANTS ── */
        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: box-shadow .2s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            right: -10px;
            top: -10px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            opacity: .04;
        }

        .stat-card:hover {
            box-shadow: 0 4px 16px rgba(15, 40, 78, .08);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 21px;
            height: 21px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.7;
        }

        .stat-num {
            font-size: 1.45rem;
            font-weight: 900;
            color: #0f284e;
            display: block;
            line-height: 1;
        }

        .stat-lbl {
            font-size: 11px;
            color: #718096;
            margin-top: 3px;
            white-space: nowrap;
        }

        .stat-evol {
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 3px;
            margin-top: 3px;
        }

        .evol-up {
            color: #2e7d32;
        }

        .evol-down {
            color: #e53935;
        }

        .stat-new {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #e53935;
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 8px;
        }

        /* Card */
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .card-head {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .card-title {
            font-size: 12px;
            font-weight: 900;
            color: #0f284e;
            text-transform: uppercase;
            letter-spacing: .08em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title::before {
            content: '';
            width: 3px;
            height: 16px;
            background: #f5c518;
            border-radius: 2px;
            display: block;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Filtres */
        .filter-bar {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
            padding: .85rem 1.25rem;
            background: #fafbfc;
            border-bottom: 1px solid #f0f4f8;
        }

        .fi {
            padding: 7px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 12px;
            outline: none;
            font-family: inherit;
            color: #1a2744;
            background: #fff;
            transition: border-color .2s;
        }

        .fi:focus {
            border-color: #0f284e;
        }

        .fi-search {
            flex: 1;
            min-width: 200px;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
        }

        .fi-search svg {
            width: 14px;
            height: 14px;
            stroke: #a0aec0;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .fi-search input {
            border: none;
            outline: none;
            font-size: 12px;
            color: #1a2744;
            width: 100%;
            font-family: inherit;
            background: transparent;
        }

        .fi-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 13px;
            padding-right: 26px;
            cursor: pointer;
        }

        .btn-filter {
            background: #0f284e;
            color: #fff;
            font-weight: 700;
            font-size: 12px;
            padding: 7px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
            white-space: nowrap;
        }

        .btn-filter:hover {
            background: #0a1e38;
        }

        .btn-reset {
            background: #f4f6fa;
            color: #718096;
            font-weight: 600;
            font-size: 12px;
            padding: 7px 12px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-reset:hover {
            color: #0f284e;
            border-color: #0f284e;
        }

        /* Table */
        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #fafbfc;
        }

        th {
            font-size: 10px;
            font-weight: 800;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 10px 14px;
            border-bottom: 1px solid #f0f4f8;
            text-align: left;
            white-space: nowrap;
        }

        th:first-child {
            padding-left: 1.25rem;
        }

        td {
            font-size: 12px;
            color: #0a1e38;
            padding: 12px 14px;
            border-bottom: 1px solid #f0f4f8;
            vertical-align: middle;
        }

        td:first-child {
            padding-left: 1.25rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafbfc;
        }

        .td-name {
            font-weight: 700;
            color: #0f284e;
        }

        .td-email {
            color: #718096;
            font-size: 11px;
        }

        .td-date {
            color: #a0aec0;
            font-size: 11px;
            white-space: nowrap;
        }

        /* Badges */
        .badge {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 10px;
            display: inline-block;
            text-transform: uppercase;
            white-space: nowrap;
            letter-spacing: .03em;
        }

        .b-confirme {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .b-en_attente {
            background: #fff8e6;
            color: #b07d10;
        }

        .b-en_attente_paiement {
            background: #ede7f6;
            color: #6a1b9a;
        }

        .b-en_cours {
            background: #e3f2fd;
            color: #0f284e;
        }

        .b-accepte {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .b-refuse {
            background: #fce4ec;
            color: #c2185b;
        }

        .b-annule {
            background: #f0f4f8;
            color: #718096;
        }

        .b-active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .b-inactive {
            background: #f0f4f8;
            color: #718096;
        }

        .b-gratuit {
            background: #f0faf0;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .b-standard {
            background: #e3f2fd;
            color: #0f284e;
            border: 1px solid #bbdefb;
        }

        .b-premium {
            background: #fff8e6;
            color: #b07d10;
            border: 1px solid #ffe082;
        }

        .b-non-lu {
            background: #e3f2fd;
            color: #0f284e;
            font-weight: 800;
        }

        .b-lu {
            background: #f0f4f8;
            color: #a0aec0;
        }

        /* Boutons action */
        .action-btns {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 5px 11px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            border: 1.5px solid;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all .2s;
            font-family: inherit;
            white-space: nowrap;
        }

        .btn-sm svg {
            width: 11px;
            height: 11px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .bsv {
            border-color: #d1d9e6;
            color: #0a1e38;
            background: #fff;
        }

        .bsv:hover {
            background: #f4f6fa;
            border-color: #0f284e;
        }

        .bsok {
            border-color: #a5d6a7;
            color: #2e7d32;
            background: #fff;
        }

        .bsok:hover {
            background: #e8f5e9;
        }

        .bsdel {
            border-color: #fecaca;
            color: #e53935;
            background: #fff;
        }

        .bsdel:hover {
            background: #fce4ec;
        }

        .bsedit {
            border-color: #bfdbfe;
            color: #0f284e;
            background: #fff;
        }

        .bsedit:hover {
            background: #e3f2fd;
        }

        .bswarn {
            border-color: #ffe082;
            color: #b07d10;
            background: #fff;
        }

        .bswarn:hover {
            background: #fff8e6;
        }

        /* Alert */
        .alert-ok {
            background: #e8f5e9;
            border: 1px solid #a5d6a7;
            color: #2e7d32;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 12px;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .alert-ok svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            flex-shrink: 0;
        }

        /* Empty state */
        .empty {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }

        .empty svg {
            width: 44px;
            height: 44px;
            stroke: #d1d9e6;
            fill: none;
            stroke-width: 1.2;
            display: block;
            margin: 0 auto .75rem;
        }

        .empty p {
            font-size: 13px;
        }

        /* Pagination */
        .pag-wrap {
            padding: 1rem 1.25rem;
            border-top: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .pag-info {
            font-size: 12px;
            color: #718096;
        }

        /* Avatar initiales */
        .av {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Grid 2 cols */
        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .grid3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1.25rem;
        }

        /* Activité timeline */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .tl-item {
            display: flex;
            gap: 12px;
            padding: 10px 1.25rem;
            border-bottom: 1px solid #f0f4f8;
            align-items: center;
        }

        .tl-item:last-child {
            border-bottom: none;
        }

        .tl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .tl-content {
            flex: 1;
            min-width: 0;
        }

        .tl-label {
            font-size: 12px;
            font-weight: 600;
            color: #0a1e38;
        }

        .tl-sub {
            font-size: 11px;
            color: #718096;
            margin-top: 1px;
        }

        .tl-time {
            font-size: 10px;
            color: #a0aec0;
            white-space: nowrap;
        }

        /* Mini chart */
        .chart-wrap {
            padding: 1.25rem;
        }

        .chart-bars {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 80px;
        }

        .chart-bar {
            flex: 1;
            border-radius: 3px 3px 0 0;
            min-height: 4px;
            transition: opacity .2s;
            cursor: default;
        }

        .chart-bar:hover {
            opacity: .8;
        }

        .chart-labels {
            display: flex;
            gap: 4px;
            padding-top: 4px;
        }

        .chart-lbl {
            flex: 1;
            font-size: 9px;
            color: #a0aec0;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Select inline */
        .inline-select {
            padding: 4px 22px 4px 8px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 11px;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 5px center;
            background-size: 11px;
            cursor: pointer;
            font-family: inherit;
            color: #0a1e38;
            background-color: #fff;
        }

        @media (max-width:1200px) {
            .stats-row {
                grid-template-columns: repeat(3, 1fr);
            }

            .grid2,
            .grid3 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:1024px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .sb {
                display: none;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width:600px) {
            .stats-row {
                grid-template-columns: 1fr;
            }

            .admin-content {
                padding: 1rem;
            }
        }
    </style>
    @yield('admin-styles')
</head>

<body>
    <div class="admin-layout">

        {{-- ══ SIDEBAR ══ --}}
        <aside class="sb">
            {{-- Brand --}}
            <div class="sb-brand">
                <div class="sb-brand-icon" style="display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('images/264.png') }}" alt="Logo JEFIE" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <div>
                    {{-- Application de la couleur orange sur Paris 2026 --}}
                    <div class="sb-brand-title">JEFIE <span style="color: var(--jefie-orange, #f5c518); font-weight: 800;">Paris 2026</span></div>
                    <div class="sb-brand-sub">Administration</div>
                </div>
            </div>


            {{-- User --}}
            <div class="sb-user">
                <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div class="sb-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="sb-user-role">{{ ucfirst(auth()->user()->role ?? 'Admin') }}</div>
                </div>
                <div class="sb-user-dot"></div>
            </div>

            {{-- Nav --}}
            <div class="sb-section">Vue d'ensemble</div>
            <a href="{{ route('admin.dashboard') }}" class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Tableau de bord
            </a>

            <div class="sb-section">Formulaires reçus</div>
            <a href="{{ route('admin.inscriptions') }}" class="sb-item {{ request()->routeIs('admin.inscriptions*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="22" y1="11" x2="16" y2="11" />
                </svg>
                Inscriptions
                @if (($counts['inscriptions_new'] ?? 0) > 0)
                <span class="sb-num red">{{ $counts['inscriptions_new'] }}</span>
                @else
                <span class="sb-num grey">{{ $counts['inscriptions'] ?? 0 }}</span>
                @endif
            </a>
            <a href="{{ route('admin.candidatures') }}" class="sb-item {{ request()->routeIs('admin.candidatures*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Candidatures
                @if (($counts['candidatures_new'] ?? 0) > 0)
                <span class="sb-num red">{{ $counts['candidatures_new'] }}</span>
                @else
                <span class="sb-num grey">{{ $counts['candidatures'] ?? 0 }}</span>
                @endif
            </a>
            <a href="{{ route('admin.contacts') }}" class="sb-item {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                </svg>
                Messages Contact
                @if (($counts['contacts_new'] ?? 0) > 0)
                <span class="sb-num red">{{ $counts['contacts_new'] }}</span>
                @endif
            </a>
            <a href="{{ route('admin.partenariats') }}" class="sb-item {{ request()->routeIs('admin.partenariats*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                </svg>
                Demandes Partenariat
                <span class="sb-num grey">{{ $counts['partenariats'] ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.rdvb2b') }}" class="sb-item {{ request()->routeIs('admin.rdvb2b*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                Rendez-vous B2B
                <span class="sb-num grey">{{ $counts['rdvb2b'] ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.newsletter') }}" class="sb-item {{ request()->routeIs('admin.newsletter*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <rect x="2" y="4" width="20" height="16" rx="2" />
                    <path d="M2 7l10 7 10-7" />
                </svg>
                Newsletter
                <span class="sb-num green">{{ $counts['newsletter'] ?? 0 }}</span>
            </a>

            <div class="sb-section">Gestion</div>
            <a href="{{ route('admin.offres') }}" class="sb-item {{ request()->routeIs('admin.offres*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Offres d'emploi
                <span class="sb-num blue">{{ $counts['offres'] ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.utilisateurs') }}" class="sb-item {{ request()->routeIs('admin.utilisateurs*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
                Utilisateurs
                <span class="sb-num grey">{{ $counts['utilisateurs'] ?? 0 }}</span>
            </a>

            <div class="sb-section">Outils</div>
            <a href="{{ route('admin.export') }}" class="sb-item {{ request()->routeIs('admin.export*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Export CSV / Excel
            </a>

            <div class="sb-bottom">
                <a href="{{ route('home') }}" class="sb-logout">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    Retour
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sb-logout">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        {{-- ══ MAIN ══ --}}
        <div class="admin-main">
            {{-- Topbar --}}
            <div class="topbar">
                <div class="topbar-left">
                    <div class="topbar-breadcrumb">
                        <span>›</span>
                        <span style="color:#0f284e;font-weight:700">@yield('page-title','Dashboard')</span>
                    </div>
                </div>
                <div class="topbar-right">
                    <div class="topbar-notif">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                        </svg>
                        @if (($counts['inscriptions_new'] ?? 0) + ($counts['contacts_new'] ?? 0) > 0)
                        <span class="notif-dot"></span>
                        @endif
                    </div>
                    <a href="{{ route('home') }}" class="btn-site">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        Retour
                    </a>
                    <a href="{{ route('admin.export') }}" class="btn-export-top">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                        </svg>
                        Exporter
                    </a>
                </div>
            </div>

            {{-- Content --}}
            <div class="admin-content">
                @if (session('success'))
                <div class="alert-ok">
                    <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    {{ session('success') }}
                </div>
                @endif
                @yield('admin-content')
            </div>
        </div>
    </div>
    @yield('admin-scripts')
</body>

</html>