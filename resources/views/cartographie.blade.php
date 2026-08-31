{{-- resources/views/cartographie/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Cartographie Diaspora — JEFIE PARIS 2026')
@section('styles')
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        color: #1a2744;
        background: #f0f2f5;
    }




    /* CARTE */
    #world-map {
        width: 100%;
        height: 420px;
        border-radius: 10px;
        z-index: 1;
        position: relative;
    }

    .leaflet-container {
        background: #b8d4e8 !important;
        border-radius: 10px !important;
        font-family: 'Segoe UI', Arial, sans-serif !important;
    }

    .leaflet-control-zoom {
        border: none !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .12) !important;
        margin-right: 14px !important;
        margin-bottom: 14px !important;
    }

    .leaflet-control-zoom a {
        background: #fff !important;
        color: #0f284e !important;
        font-weight: 700 !important;
        font-size: 18px !important;
        width: 32px !important;
        height: 32px !important;
        line-height: 32px !important;
        border: 1px solid #d1d9e6 !important;
        border-radius: 5px !important;
        margin-bottom: 4px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
    }

    .leaflet-control-zoom a:hover {
        background: #f4f6fa !important;
    }

    .leaflet-control-attribution {
        display: none !important;
    }

    .leaflet-popup-content-wrapper {
        border-radius: 10px !important;
        box-shadow: 0 4px 16px rgba(15, 40, 78, .18) !important;
        border: 1px solid #e2e8f0 !important;
        padding: 0 !important;
    }

    .leaflet-popup-content {
        margin: 0 !important;
        padding: 0 !important;
    }

    .leaflet-popup-tip-container {
        display: none;
    }

    /* Cluster */
    .lf-cluster {
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        border: 2.5px solid rgba(255, 255, 255, .55);
        box-shadow: 0 3px 10px rgba(0, 0, 0, .3);
        cursor: pointer;
        transition: transform .15s;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .lf-cluster:hover {
        transform: scale(1.12) !important;
    }

    /* Popup */
    .map-popup-inner {
        padding: 12px 14px;
        min-width: 190px;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .map-popup-pays {
        font-size: 13px;
        font-weight: 700;
        color: #0a1e38;
        margin-bottom: 3px;
    }

    .map-popup-count {
        font-size: 12px;
        color: #718096;
        margin-bottom: 10px;
        border-bottom: 1px solid #f0f4f8;
        padding-bottom: 8px;
    }

    .map-popup-rows {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .map-popup-row {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        color: #4a5568;
    }

    .map-popup-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .map-popup-row span {
        flex: 1;
    }

    .map-popup-row strong {
        color: #0f284e;
    }

    /* ── NAV ── */
    .nav {
        background: #0f284e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.75rem;
        height: 64px;
        position: sticky;
        top: 0;
        z-index: 200;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo-icon {
        width: 42px;
        height: 42px;
        border: 2px solid #f5c518;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-logo-text {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.3;
        text-transform: uppercase;
    }

    .nav-logo-text span {
        color: #f5c518;
        display: block;
        font-size: 11px;
    }

    .nav-logo-text small {
        color: #f5c518;
        font-size: 9px;
        font-weight: 700;
    }

    .nav-links {
        display: flex;
        gap: 1.3rem;
        align-items: center;
    }

    .nav-links a {
        color: rgba(255, 255, 255, .75);
        font-size: 13px;
        text-decoration: none;
        white-space: nowrap;
        transition: color .2s;
    }

    .nav-links a:hover {
        color: #fff;
    }

    .nav-links a.active {
        color: #fff;
        border-bottom: 2px solid #f5c518;
        padding-bottom: 2px;
        font-weight: 600;
    }

    .nav-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-icon-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, .7);
        cursor: pointer;
        padding: 6px;
        display: flex;
        align-items: center;
    }

    .nav-icon-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .nav-user {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        padding: 5px 12px;
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 20px;
    }

    .nav-user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f5c518, #e09010);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .nav-user-avatar img {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
    }

    .nav-user svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ── LANGUAGE SWITCHER ── */
    * Styles optionnels pour que le sélecteur de langue et le bouton s'alignent parfaitement en hauteur */
 .lang-switcher {
        position: relative;
        display: inline-block;
    }

    .lang-btn,
    .nav-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 5px;
        padding: 7px 12px;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        font-family: inherit;
    }

    .lang-btn:hover {
        background: rgba(255, 255, 255, .14);
    }

    .lang-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .lang-flag {
        font-size: 14px;
        line-height: 1;
    }

    .lang-dropdown {
        display: none;
        /* Caché par défaut */
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background: #ffffff;
        /* Ou couleur sombre selon votre thème */
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 150px;
        z-index: 1000;
    }

    .lang-switcher:hover .lang-dropdown,
    .lang-dropdown.open {
        display: block;
    }

    .lang-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        color: #333;
        text-decoration: none;
        transition: background 0.2s;
    }

    .lang-item:last-child {
        border-bottom: none;
    }

    .lang-item:hover {
        background: #f4f4f4;
    }

    .lang-item.active {
        font-weight: bold;
    }

    .lang-item.active .lang-item-flag {
        filter: brightness(1);
    }

    .lang-item-flag {
        font-size: 16px;
        flex-shrink: 0;
    }

    .lang-item-name {
        font-weight: 400;
    }

    .lang-item-code {
        color: #888888;
        /* Remplacez par le code gris de votre choix, ex: #6b7280 */
        font-size: 0.75rem;
        font-weight: 500;
    }

    .lang-item.active .lang-item-code {
        color: #888888;
        ;
    }

    .lang-check {
        margin-left: auto;
    }

    .lang-check svg {
        width: 14px;
        height: 14px;
        fill: none;
        stroke-width: 2.5;
    }


    /* ── PAGE LAYOUT ── */
    .page-layout {
        display: grid;
        grid-template-columns: 240px 1fr 290px;
        min-height: calc(100vh - 64px);
    }

    /* ══ SIDEBAR FILTRES ══ */
    .filters-sidebar {
        background: #fff;
        border-right: 1px solid #e2e8f0;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        overflow-y: auto;
    }

    .filters-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .filters-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .filters-reset {
        font-size: 12px;
        color: #f5c518;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .filter-group-label {
        font-size: 11px;
        font-weight: 700;
        color: #0a1e38;
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .filter-input {
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        padding: 8px 12px;
        transition: border-color .2s;
    }

    .filter-input:focus-within {
        border-color: #0f284e;
    }

    .filter-input input {
        flex: 1;
        border: none;
        outline: none;
        font-size: 12px;
        color: #1a2744;
        background: transparent;
    }

    .filter-input input::placeholder {
        color: #a0aec0;
    }

    .filter-input svg {
        width: 14px;
        height: 14px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .filter-select {
        width: 100%;
        padding: 8px 28px 8px 10px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        color: #1a2744;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 14px;
        cursor: pointer;
        font-family: inherit;
    }

    .filter-sep {
        height: 1px;
        background: #f0f4f8;
    }

    .checkbox-list {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .cb-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cb-left {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .cb-left input[type="checkbox"] {
        width: 14px;
        height: 14px;
        accent-color: #0f284e;
        cursor: pointer;
        flex-shrink: 0;
    }

    .cb-left label {
        font-size: 12px;
        color: #4a5568;
        cursor: pointer;
    }

    .cb-count {
        font-size: 11px;
        font-weight: 700;
        color: #0f284e;
    }

    .range-wrap {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .range-labels {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #718096;
    }

    .range-slider {
        width: 100%;
        accent-color: #0f284e;
        cursor: pointer;
    }

    .year-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        color: #718096;
    }

    .year-val {
        font-weight: 700;
        color: #0f284e;
    }

    .apply-btn {
        background: #0f284e;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        padding: 11px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background .2s;
        font-family: inherit;
    }

    .apply-btn:hover {
        background: #0a1e38;
    }

    .apply-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    /* ══ MAIN ══ */
    .main-content {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    /* Stats bar */
    .stats-bar {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        gap: 1px;
        background: #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .stat-box {
        background: #fff;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .stat-box.dark {
        background: #0f284e;
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        font-size: 11px;
        color: #718096;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .stat-box.dark .stat-label {
        color: rgba(255, 255, 255, .65);
    }

    .stat-num {
        font-size: 1.4rem;
        font-weight: 900;
        color: #0f284e;
        line-height: 1;
    }

    .stat-box.dark .stat-num {
        color: #fff;
    }

    .stat-evol {
        font-size: 11px;
        font-weight: 700;
        color: #2e7d32;
        margin-top: 3px;
    }

    .stat-sous {
        font-size: 10px;
        color: #a0aec0;
        margin-top: 1px;
    }

    .stat-box.dark .stat-sous {
        color: rgba(255, 255, 255, .45);
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.7;
    }

    /* Map section */
    .map-section {
        flex: 1;
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .map-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .map-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .map-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .map-control-group {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .map-control-label {
        font-size: 11px;
        color: #718096;
        white-space: nowrap;
    }

    .map-select {
        padding: 6px 24px 6px 10px;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        font-size: 12px;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath d='M5 8l5 5 5-5' stroke='%23718096' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 7px center;
        background-size: 13px;
        cursor: pointer;
        min-width: 130px;
        font-family: inherit;
    }

    .map-expand-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .map-expand-btn svg {
        width: 14px;
        height: 14px;
        stroke: #718096;
        fill: none;
        stroke-width: 2;
    }

    .map-tabs {
        display: flex;
        gap: 2px;
        background: #e2e8f0;
        border-radius: 6px;
        padding: 3px;
        width: fit-content;
    }

    .map-tab {
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        border: none;
        background: transparent;
        color: #718096;
        transition: all .2s;
        font-family: inherit;
    }

    .map-tab.active {
        background: #0f284e;
        color: #fff;
    }

    /* Carte mondiale SVG */
    .map-container {
        background: #dce8f5;
        border: 1px solid #c8d8e8;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        flex: 1;
        min-height: 360px;
    }

    .map-canvas {
        width: 100%;
        height: 100%;
        min-height: 360px;
        position: relative;
    }

    .map-world-svg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    .map-zoom-controls {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 4px;
        z-index: 10;
    }

    .map-zoom-btn {
        width: 30px;
        height: 30px;
        background: #fff;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        font-weight: 700;
        color: #0f284e;
        line-height: 1;
    }

    .map-settings-btn {
        position: absolute;
        right: 14px;
        bottom: 50px;
        width: 30px;
        height: 30px;
        background: #fff;
        border: 1px solid #d1d9e6;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }

    .map-settings-btn svg {
        width: 15px;
        height: 15px;
        stroke: #718096;
        fill: none;
        stroke-width: 1.8;
    }

    /* Clusters sur la carte */
    .map-cluster {
        position: absolute;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        cursor: pointer;
        transition: transform .2s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .25);
        border: 2px solid rgba(255, 255, 255, .4);
    }

    .map-cluster:hover {
        transform: translate(-50%, -50%) scale(1.12);
        z-index: 10;
    }

    .map-cluster-sm {
        width: 34px;
        height: 34px;
        font-size: 10px;
    }

    .map-cluster-md {
        width: 46px;
        height: 46px;
        font-size: 13px;
    }

    .map-cluster-lg {
        width: 58px;
        height: 58px;
        font-size: 14px;
    }

    .map-cluster-xl {
        width: 70px;
        height: 70px;
        font-size: 16px;
    }

    .map-legend {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        padding: .6rem 1rem;
        background: #fff;
        border-top: 1px solid #e2e8f0;
    }

    .map-legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #4a5568;
    }

    .map-legend-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* Entrepreneurs à la une */
    .une-section {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e2e8f0;
        background: #fff;
    }

    .une-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: .85rem;
    }

    .une-title {
        font-size: 12px;
        font-weight: 900;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .une-see-all {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .une-see-all svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
    }

    .une-carousel {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .une-arrow {
        width: 30px;
        height: 30px;
        background: #f4f6fa;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .2s;
    }

    .une-arrow:hover {
        background: #e2e8f0;
    }

    .une-arrow svg {
        width: 13px;
        height: 13px;
        stroke: #0a1e38;
        fill: none;
        stroke-width: 2;
    }

    .une-list {
        display: flex;
        gap: .85rem;
        overflow-x: auto;
        flex: 1;
        scrollbar-width: none;
        scroll-snap-type: x mandatory;
    }

    .une-list::-webkit-scrollbar {
        display: none;
    }

    .une-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: .85rem;
        min-width: 185px;
        flex-shrink: 0;
        scroll-snap-align: start;
        display: flex;
        flex-direction: column;
        gap: 6px;
        transition: box-shadow .2s;
    }

    .une-card:hover {
        box-shadow: 0 2px 10px rgba(15, 40, 78, .08);
    }

    .une-card-top {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .une-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f284e, #0a1e38);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .une-avatar img {
        width: 42px;
        height: 42px;
        object-fit: cover;
        display: block;
        border-radius: 50%;
    }

    .une-avatar-init {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
    }

    .une-name {
        font-size: 12px;
        font-weight: 700;
        color: #0a1e38;
        line-height: 1.25;
    }

    .une-company {
        font-size: 11px;
        color: #718096;
    }

    .une-sector {
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 3px;
        display: inline-block;
        width: fit-content;
    }

    .sector-tech {
        background: #e3f2fd;
        color: #0f284e;
    }

    .sector-agri {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .sector-services {
        background: #ede7f6;
        color: #6a1b9a;
    }

    .sector-sante {
        background: #fce4ec;
        color: #c2185b;
    }

    .sector-industrie {
        background: #fff3e0;
        color: #f5c518;
    }

    .une-meta {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .une-meta-row {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #718096;
    }

    .une-meta-row svg {
        width: 11px;
        height: 11px;
        stroke: #a0aec0;
        fill: none;
        stroke-width: 1.8;
        flex-shrink: 0;
    }

    .une-ca {
        font-size: 12px;
        font-weight: 800;
        color: #f5c518;
        margin-top: 2px;
    }

    /* ══ SIDEBAR DROITE ══ */
    .right-sidebar {
        background: #fff;
        border-left: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .rs-block {
        padding: 1.1rem;
        border-bottom: 1px solid #f0f4f8;
    }

    .rs-block:last-child {
        border-bottom: none;
        flex: 1;
    }

    .rs-title {
        font-size: 11px;
        font-weight: 900;
        color: #0f284e;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .85rem;
    }

    .donut-wrap {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .donut {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        flex-shrink: 0;
        position: relative;
    }

    .donut-inner {
        position: absolute;
        inset: 18px;
        background: #fff;
        border-radius: 50%;
    }

    .donut-legend {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .donut-legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .donut-legend-left {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .donut-legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .donut-legend-label {
        font-size: 11px;
        color: #4a5568;
    }

    .donut-legend-pct {
        font-size: 10px;
        font-weight: 700;
        color: #0a1e38;
    }

    .secteur-item {
        margin-bottom: 9px;
    }

    .secteur-item:last-child {
        margin-bottom: 0;
    }

    .secteur-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .secteur-name {
        font-size: 12px;
        color: #0a1e38;
    }

    .secteur-nums {
        font-size: 10px;
        color: #718096;
    }

    .secteur-bar-bg {
        height: 5px;
        background: #f0f4f8;
        border-radius: 3px;
        overflow: hidden;
    }

    .secteur-bar-fill {
        height: 100%;
        border-radius: 3px;
    }

    /* ══ INDICATEURS BAS ══ */
    .indicators-bar {
        background: #0f284e;
        display: flex;
        align-items: stretch;
    }

    .indicator-aside {
        padding: 1.1rem 1.25rem;
        border-right: 1px solid rgba(255, 255, 255, .1);
        min-width: 155px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: .5rem;
    }

    .indicator-aside-title {
        font-size: 10px;
        font-weight: 800;
        color: rgba(255, 255, 255, .6);
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .indicator-aside-select {
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 4px;
        color: #fff;
        font-size: 12px;
        padding: 5px 8px;
        outline: none;
        width: 100%;
        cursor: pointer;
        font-family: inherit;
    }

    .indicators-list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        flex: 1;
    }

    .indicator-item {
        padding: 1rem 1.25rem;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }

    .indicator-item:last-child {
        border-right: none;
    }

    .indicator-label {
        font-size: 10px;
        color: rgba(255, 255, 255, .55);
        margin-bottom: 4px;
    }

    .indicator-num {
        font-size: 1.2rem;
        font-weight: 900;
        color: #fff;
        line-height: 1;
        margin-bottom: 3px;
    }

    .indicator-evol {
        font-size: 11px;
        font-weight: 700;
        color: #4caf50;
    }

    .indicator-chart {
        height: 28px;
        margin-top: 5px;
        overflow: hidden;
    }

    .indicator-chart svg {
        width: 100%;
        height: 28px;
    }

    .dl-block {
        background: #0f284e;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.1rem 1.5rem;
        border-left: 1px solid rgba(255, 255, 255, .1);
    }

    .dl-icon {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dl-icon svg {
        width: 20px;
        height: 20px;
        stroke: #f5c518;
        fill: none;
        stroke-width: 1.8;
    }

    .dl-text p {
        font-size: 12px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 2px;
    }

    .dl-text span {
        font-size: 11px;
        color: rgba(255, 255, 255, .6);
    }

    .dl-btn {
        background: #fff;
        color: #0f284e;
        font-weight: 700;
        font-size: 12px;
        padding: 9px 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        margin-left: auto;
        text-decoration: none;
        transition: opacity .2s;
        flex-shrink: 0;
    }

    .dl-btn:hover {
        opacity: .9;
    }

    /* Footer */
    .site-footer {
        background: #0f284e;
        color: rgba(255, 255, 255, .7);
        padding: 2rem 2rem 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .fb p {
        font-size: 12px;
        line-height: 1.6;
        margin: .5rem 0 .75rem;
    }

    .socials {
        display: flex;
        gap: 8px;
    }

    .socials a {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: background .2s;
    }

    .socials a:hover {
        background: rgba(255, 255, 255, .2);
    }

    .fc h4 {
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: .75rem;
    }

    .fc a {
        display: block;
        color: rgba(255, 255, 255, .6);
        text-decoration: none;
        font-size: 12px;
        margin-bottom: 5px;
        transition: color .2s;
    }

    .fc a:hover {
        color: #fff;
    }

    .fci {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        margin-bottom: 6px;
        color: rgba(255, 255, 255, .7);
    }

    .fci svg {
        flex-shrink: 0;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding: 1rem 0;
        text-align: center;
        font-size: 11px;
        color: rgba(255, 255, 255, .35);
    }

    @media (max-width:1200px) {
        .page-layout {
            grid-template-columns: 240px 1fr;
        }

        .right-sidebar {
            display: none;
        }

        .stats-bar {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width:900px) {
        .page-layout {
            grid-template-columns: 1fr;
        }

        .filters-sidebar {
            display: none;
        }

        .stats-bar {
            grid-template-columns: 1fr 1fr;
        }

        .indicators-list {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:600px) {
        .stats-bar {
            grid-template-columns: 1fr;
        }

        .indicators-list {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

@include('components.navbar')


<div class="page-layout">

    {{-- ══ SIDEBAR FILTRES ══ --}}
    <aside class="filters-sidebar">
        <div class="filters-header">
            <span class="filters-title">Filtres</span>
            <a href="{{ route('cartographie') }}" class="filters-reset">Réinitialiser</a>
        </div>
        <form action="{{ route('cartographie') }}" method="GET" id="filtres-form">

            <div class="filter-group">
                <span class="filter-group-label">Recherche globale</span>
                <div class="filter-input">
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom, entreprise, secteur, pays...">
                </div>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Localisation</span>
                <select name="pays" class="filter-select">
                    <option value="">Tous les pays</option>
                    @foreach ($pays as $p)
                    <option value="{{ $p }}" {{ request('pays') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                <select name="ville" class="filter-select" style="margin-top:6px">
                    <option value="">Toutes les villes</option>
                    @foreach ($villes as $v)
                    <option value="{{ $v }}" {{ request('ville') === $v ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Secteur d'activité</span>
                <select name="secteur" class="filter-select">
                    <option value="">Tous les secteurs</option>
                    @foreach ($secteurs as $s)
                    <option value="{{ $s }}" {{ request('secteur') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Taille de l'entreprise</span>
                <div class="checkbox-list">
                    @foreach ([['micro','Micro entreprise (1 - 10)','1 245'],['petite','Petite entreprise (11 - 50)','876'],['moyenne','Moyenne entreprise (51 - 250)','456'],['grande','Grande entreprise (250+)','234']] as [$val,$lbl,$cnt])
                    <div class="cb-item">
                        <div class="cb-left">
                            <input type="checkbox" id="taille_{{ $val }}" name="tailles[]" value="{{ $val }}" {{ in_array($val, request()->input('tailles',[])) ? 'checked' : '' }}>
                            <label for="taille_{{ $val }}">{{ $lbl }}</label>
                        </div>
                        <span class="cb-count">{{ $cnt }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Chiffre d'affaires annuel</span>
                <div class="range-wrap">
                    <input type="range" class="range-slider" name="ca_max" min="0" max="10000" value="{{ request('ca_max',10000) }}"
                        oninput="document.getElementById('ca-val').textContent=this.value>=10000?'10 Mds+ FCFA':this.value+'M FCFA'">
                    <div class="range-labels"><span>0 FCFA</span><span id="ca-val">10 Mds+ FCFA</span></div>
                </div>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Capacité économique</span>
                <div class="checkbox-list">
                    @foreach ([['emergente','Émergente','1 089'],['en_croissance','En croissance','1 256'],['etablie','Établie','1 034'],['leader','Leader','432']] as [$val,$lbl,$cnt])
                    <div class="cb-item">
                        <div class="cb-left">
                            <input type="checkbox" id="cap_{{ $val }}" name="capacites[]" value="{{ $val }}" {{ in_array($val, request()->input('capacites',[])) ? 'checked' : '' }}>
                            <label for="cap_{{ $val }}">{{ $lbl }}</label>
                        </div>
                        <span class="cb-count">{{ $cnt }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="filter-sep"></div>

            <div class="filter-group">
                <span class="filter-group-label">Année de création</span>
                <div class="year-row">
                    <span class="year-val" id="year-min-lbl">1990</span>
                    <span class="year-val" id="year-max-lbl">2024</span>
                </div>
                <input type="range" class="range-slider" name="annee_min" min="1990" max="2024" value="{{ request('annee_min',1990) }}"
                    oninput="document.getElementById('year-min-lbl').textContent=this.value">
                <input type="range" class="range-slider" name="annee_max" min="1990" max="2024" value="{{ request('annee_max',2024) }}"
                    oninput="document.getElementById('year-max-lbl').textContent=this.value" style="margin-top:4px">
            </div>

            <button type="submit" class="apply-btn">
                <svg viewBox="0 0 24 24">
                    <line x1="4" y1="6" x2="20" y2="6" />
                    <line x1="4" y1="12" x2="14" y2="12" />
                    <line x1="4" y1="18" x2="8" y2="18" />
                </svg>
                Appliquer les filtres
            </button>
        </form>
    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="main-content">

        {{-- Stats bar --}}
        <div class="stats-bar">
            @foreach ($stats as $s)
            <div class="stat-box {{ $loop->first ? 'dark' : '' }}">
                <div class="stat-info">
                    <div class="stat-label">{{ $s['label'] }}</div>
                    <div class="stat-num">{{ $s['valeur'] }}</div>
                    <div class="stat-evol">{{ $s['evolution'] }}</div>
                    <div class="stat-sous">vs année précédente</div>
                </div>
                <div class="stat-icon" style="background:{{ $s['bg'] ?? 'transparent' }}">
                    <svg viewBox="0 0 24 24" style="stroke:{{ $s['color'] }}" aria-hidden="true">{!! $s['icon'] !!}</svg>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Carte --}}
        <div class="map-section">
            <div class="map-header">
                <h2 class="map-title">Carte Mondiale des Entrepreneurs Gabonais de la Diaspora</h2>
                <div class="map-controls">
                    <div class="map-tabs">
                        <button class="map-tab active" onclick="switchTab(this,'pays')">Vue par pays</button>
                        <button class="map-tab" onclick="switchTab(this,'ville')">Vue par ville</button>
                    </div>
                    <div class="map-control-group">
                        <span class="map-control-label">Afficher par :</span>
                        <select class="map-select">
                            <option>Entrepreneurs</option>
                            <option>Entreprises</option>
                            <option>Emplois créés</option>
                        </select>
                    </div>
                    <div class="map-control-group">
                        <span class="map-control-label">Couleur par :</span>
                        <select class="map-select">
                            <option>Secteur d'activité</option>
                            <option>Capacité économique</option>
                            <option>Taille d'entreprise</option>
                        </select>
                    </div>
                    <button class="map-expand-btn"><svg viewBox="0 0 24 24">
                            <polyline points="15 3 21 3 21 9" />
                            <polyline points="9 21 3 21 3 15" />
                            <line x1="21" y1="3" x2="14" y2="10" />
                            <line x1="3" y1="21" x2="10" y2="14" />
                        </svg></button>
                </div>
            </div>

            {{-- ✅ REMPLACER TOUTE LA SECTION .map-container dans cartographie/index.blade.php --}}

            {{-- Dans @section('styles'), ajouter APRÈS votre CSS existant : --}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
            <style>
                /* ── CARTE LEAFLET ── */
                #world-map {
                    width: 100%;
                    height: 420px;
                    background: #c8ddef;
                    border-radius: 10px;
                    z-index: 1;
                }

                .leaflet-container {
                    background: #c8ddef !important;
                    border-radius: 10px;
                }

                .leaflet-tile-pane {
                    opacity: 0 !important;
                }

                /* cache les tuiles → fond uni comme maquette */

                /* Clusters personnalisés */
                .custom-cluster {
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-weight: 800;
                    border: 2.5px solid rgba(255, 255, 255, .5);
                    box-shadow: 0 2px 8px rgba(0, 0, 0, .3);
                    cursor: pointer;
                    transition: transform .15s;
                }

                .custom-cluster:hover {
                    transform: scale(1.12);
                }

                /* Contrôles zoom custom */
                .leaflet-control-zoom {
                    border: none !important;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, .15) !important;
                }

                .leaflet-control-zoom a {
                    background: #fff !important;
                    color: #0f284e !important;
                    font-weight: 700 !important;
                    font-size: 16px !important;
                    line-height: 28px !important;
                    width: 30px !important;
                    height: 30px !important;
                    border-radius: 5px !important;
                    border: 1px solid #d1d9e6 !important;
                    margin-bottom: 4px !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                }

                .leaflet-control-zoom a:hover {
                    background: #f4f6fa !important;
                }

                .leaflet-control-attribution {
                    display: none !important;
                }

                /* Popup entrepreneur */
                .map-popup {
                    font-family: 'Segoe UI', Arial, sans-serif;
                    min-width: 180px;
                }

                .map-popup-name {
                    font-size: 13px;
                    font-weight: 700;
                    color: #0a1e38;
                    margin-bottom: 2px;
                }

                .map-popup-count {
                    font-size: 12px;
                    color: #718096;
                    margin-bottom: 8px;
                }

                .map-popup-list {
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                }

                .map-popup-item {
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    font-size: 11px;
                    color: #4a5568;
                }

                .map-popup-dot {
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    flex-shrink: 0;
                }

                .leaflet-popup-content-wrapper {
                    border-radius: 8px !important;
                    box-shadow: 0 4px 16px rgba(15, 40, 78, .15) !important;
                    border: 1px solid #e2e8f0 !important;
                }

                .leaflet-popup-tip {
                    background: #fff !important;
                }
            </style>


            {{-- ══ ÉTAPE 2 : Remplacer div.map-container ══ --}}
            <div style="padding:0;background:transparent;border:none;border-radius:10px;overflow:hidden">
                <div id="world-map"></div>
                <div class="map-legend" style="background:#fff;border-top:1px solid #e2e8f0;padding:.6rem 1rem;display:flex;gap:1rem;flex-wrap:wrap">
                    @foreach ([
                    ['#1e88e5','Technologies'],
                    ['#43a047','Services'],
                    ['#fb8c00','Industrie'],
                    ['#8e24aa','Commerce'],
                    ['#00897b','Agriculture'],
                    ['#e53935','Santé'],
                    ['#f4511e','Éducation'],
                    ['#90a4ae','Autres'],
                    ] as [$color, $label])
                    <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:#4a5568">
                        <span style="width:9px;height:9px;border-radius:50%;background:{{ $color }};flex-shrink:0;display:inline-block"></span>
                        {{ $label }}
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ══ ÉTAPE 3 : @push('scripts') ══ --}}
            @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    // ── Initialisation ──────────────────────────────────────────────
                    var map = L.map('world-map', {
                        center: [25, 15],
                        zoom: 2,
                        minZoom: 1,
                        maxZoom: 8,
                        zoomControl: true,
                        attributionControl: false,
                        scrollWheelZoom: true,
                    });

                    // Tuiles CartoDB style clair — très proche de la maquette
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_nolabels/{z}/{x}/{y}{r}.png', {
                        subdomains: 'abcd',
                        maxZoom: 19,
                    }).addTo(map);

                    // ── Points de données (identiques à la maquette) ────────────────
                    var points = [
                        // [lat, lng, count, couleur, pays, [[secteur, couleur, nb], ...]]
                        [46.23, 2.21, 1256, '#e53935', 'France',
                            [
                                ['Technologies', '#1e88e5', 380],
                                ['Services', '#43a047', 290],
                                ['Commerce', '#8e24aa', 220],
                                ['Industrie', '#fb8c00', 210],
                                ['Agriculture', '#00897b', 156]
                            ]
                        ],
                        [50.85, 4.35, 312, '#1e88e5', 'Belgique',
                            [
                                ['Services', '#43a047', 95],
                                ['Technologies', '#1e88e5', 88],
                                ['Commerce', '#8e24aa', 70],
                                ['Industrie', '#fb8c00', 59]
                            ]
                        ],
                        [51.16, 10.45, 178, '#43a047', 'Allemagne',
                            [
                                ['Industrie', '#fb8c00', 62],
                                ['Technologies', '#1e88e5', 55],
                                ['Services', '#43a047', 38],
                                ['Commerce', '#8e24aa', 23]
                            ]
                        ],
                        [40.41, -3.70, 224, '#8e24aa', 'Espagne',
                            [
                                ['Commerce', '#8e24aa', 78],
                                ['Services', '#43a047', 60],
                                ['Tourisme', '#f4511e', 50],
                                ['Technologies', '#1e88e5', 36]
                            ]
                        ],
                        [52.13, 5.29, 96, '#fb8c00', 'Pays-Bas',
                            [
                                ['Finance', '#00897b', 35],
                                ['Technologies', '#1e88e5', 30],
                                ['Services', '#43a047', 31]
                            ]
                        ],
                        [51.51, -0.13, 180, '#e53935', 'Royaume-Uni',
                            [
                                ['Finance', '#00897b', 65],
                                ['Technologies', '#1e88e5', 55],
                                ['Services', '#43a047', 60]
                            ]
                        ],
                        [45.46, 12.33, 89, '#f4511e', 'Italie',
                            [
                                ['Commerce', '#8e24aa', 35],
                                ['Tourisme', '#f4511e', 30],
                                ['Services', '#43a047', 24]
                            ]
                        ],
                        [48.86, 2.35, 45, '#43a047', 'Portugal',
                            [
                                ['Commerce', '#8e24aa', 20],
                                ['Services', '#43a047', 15],
                                ['Agriculture', '#00897b', 10]
                            ]
                        ],
                        [37.09, -95.71, 532, '#00897b', 'États-Unis',
                            [
                                ['Technologies', '#1e88e5', 180],
                                ['Finance', '#00897b', 120],
                                ['Services', '#43a047', 130],
                                ['Industrie', '#fb8c00', 102]
                            ]
                        ],
                        [56.13, -106.35, 124, '#f4511e', 'Canada',
                            [
                                ['Technologies', '#1e88e5', 45],
                                ['Services', '#43a047', 40],
                                ['Commerce', '#8e24aa', 39]
                            ]
                        ],
                        [-14.24, -51.93, 74, '#43a047', 'Brésil',
                            [
                                ['Agriculture', '#00897b', 32],
                                ['Commerce', '#8e24aa', 22],
                                ['Services', '#43a047', 20]
                            ]
                        ],
                        [-30.56, 22.94, 58, '#1e88e5', 'Afrique du Sud',
                            [
                                ['Industrie', '#fb8c00', 22],
                                ['Commerce', '#8e24aa', 18],
                                ['Services', '#43a047', 18]
                            ]
                        ],
                        [-0.23, 15.83, 96, '#e53935', 'Congo/Gabon',
                            [
                                ['Agriculture', '#00897b', 38],
                                ['Commerce', '#8e24aa', 28],
                                ['Services', '#43a047', 30]
                            ]
                        ],
                        [-25.27, 133.77, 38, '#fb8c00', 'Australie',
                            [
                                ['Ingénierie', '#8e24aa', 18],
                                ['Services', '#43a047', 12],
                                ['Commerce', '#8e24aa', 8]
                            ]
                        ],
                        [35.86, 104.20, 42, '#8e24aa', 'Chine',
                            [
                                ['Commerce', '#8e24aa', 20],
                                ['Technologies', '#1e88e5', 14],
                                ['Industrie', '#fb8c00', 8]
                            ]
                        ],
                        [20.59, 78.96, 35, '#1e88e5', 'Inde',
                            [
                                ['Technologies', '#1e88e5', 18],
                                ['Services', '#43a047', 10],
                                ['Commerce', '#8e24aa', 7]
                            ]
                        ],
                        [25.20, 55.27, 45, '#00897b', 'Émirats Arabes',
                            [
                                ['Finance', '#00897b', 22],
                                ['Commerce', '#8e24aa', 15],
                                ['Services', '#43a047', 8]
                            ]
                        ],
                        [1.35, 103.82, 22, '#8e24aa', 'Singapour',
                            [
                                ['Finance', '#00897b', 10],
                                ['Technologies', '#1e88e5', 8],
                                ['Commerce', '#8e24aa', 4]
                            ]
                        ],
                        [-1.29, 36.82, 18, '#43a047', 'Kenya',
                            [
                                ['Agriculture', '#00897b', 8],
                                ['Commerce', '#8e24aa', 6],
                                ['Services', '#43a047', 4]
                            ]
                        ],
                        [14.50, -14.45, 15, '#e53935', 'Sénégal',
                            [
                                ['Agriculture', '#00897b', 6],
                                ['Commerce', '#8e24aa', 5],
                                ['Services', '#43a047', 4]
                            ]
                        ],
                        [5.35, -4.00, 28, '#1e88e5', "Côte d'Ivoire",
                            [
                                ['Commerce', '#8e24aa', 12],
                                ['Agriculture', '#00897b', 10],
                                ['Services', '#43a047', 6]
                            ]
                        ],
                        [3.85, 11.50, 20, '#43a047', 'Cameroun',
                            [
                                ['Agriculture', '#00897b', 8],
                                ['Services', '#43a047', 7],
                                ['Commerce', '#8e24aa', 5]
                            ]
                        ],
                    ];


                    // ── Calcul taille cluster ───────────────────────────────────────
                    function getSize(n) {
                        if (n >= 1000) return {
                            sz: 64,
                            fs: '15px'
                        };
                        if (n >= 400) return {
                            sz: 56,
                            fs: '14px'
                        };
                        if (n >= 150) return {
                            sz: 46,
                            fs: '13px'
                        };
                        if (n >= 50) return {
                            sz: 38,
                            fs: '12px'
                        };
                        return {
                            sz: 30,
                            fs: '11px'
                        };
                    }

                    // ── Création des markers ────────────────────────────────────────
                    points.forEach(function(p) {
                        var lat = p[0],
                            lng = p[1],
                            count = p[2],
                            color = p[3],
                            pays = p[4],
                            secteurs = p[5];
                        var {
                            sz,
                            fs
                        } = getSize(count);

                        var icon = L.divIcon({
                            className: '',
                            html: '<div class="lf-cluster" style="' +
                                'width:' + sz + 'px;height:' + sz + 'px;' +
                                'background:' + color + ';' +
                                'font-size:' + fs + ';' +
                                '">' + count + '</div>',
                            iconSize: [sz, sz],
                            iconAnchor: [sz / 2, sz / 2],
                            popupAnchor: [0, -(sz / 2 + 5)],
                        });

                        var popupRows = secteurs.map(function(s) {
                            return '<div class="map-popup-row">' +
                                '<span class="map-popup-dot" style="background:' + s[1] + '"></span>' +
                                '<span>' + s[0] + ' : <strong>' + s[2] + '</strong></span>' +
                                '</div>';
                        }).join('');

                        var popup = '<div class="map-popup-inner">' +
                            '<div class="map-popup-pays">' + pays + '</div>' +
                            '<div class="map-popup-count">' + count + ' entrepreneur' + (count > 1 ? 's' : '') + ' répertorié' + (count > 1 ? 's' : '') + '</div>' +
                            '<div class="map-popup-rows">' + popupRows + '</div>' +
                            '</div>';

                        L.marker([lat, lng], {
                                icon: icon
                            })
                            .bindPopup(popup, {
                                maxWidth: 240,
                                minWidth: 200
                            })
                            .addTo(map);
                    });

                    // ── Switcher onglets ────────────────────────────────────────────
                    window.switchTab = function(btn, view) {
                        document.querySelectorAll('.map-tab').forEach(function(t) {
                            t.classList.remove('active');
                        });
                        btn.classList.add('active');
                    };

                }); // DOMContentLoaded
            </script>
            @endpush



            {{-- Entrepreneurs à la une --}}
            <div class="une-section">
                <div class="une-header">
                    <h2 class="une-title">Entrepreneurs à la Une</h2>
                    <a href="{{ route('entrepreneurs.annuaire') }}" class="une-see-all">
                        Voir tous les entrepreneurs
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="une-carousel">
                    <button class="une-arrow" onclick="document.getElementById('une-list').scrollBy(-210,0)"><svg viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6" />
                        </svg></button>
                    <div class="une-list" id="une-list">
                        @forelse ($entrepreneursUne as $e)
                        <div class="une-card">
                            <div class="une-card-top">
                                <div class="une-avatar">
                                    @if ($e->photo ?? false)
                                    <img src="{{ asset('images/'.$e->photo) }}" alt="{{ $e->nom_complet }}">
                                    @else
                                    <span class="une-avatar-init">{{ strtoupper(substr($e->nom_complet,0,1)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="une-name">{{ $e->nom_complet }}</div>
                                    <div class="une-company">{{ $e->entreprise }}</div>
                                </div>
                            </div>
                            <span class="une-sector sector-{{ $e->secteur_css ?? 'tech' }}">{{ $e->secteur_activite }}</span>
                            <div class="une-meta">
                                <div class="une-meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $e->ville }}, {{ $e->pays_residence }}
                                </div>
                                <div class="une-meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg>
                                    {{ $e->taille_employes }}
                                </div>
                            </div>
                            <div class="une-ca">CA: {{ $e->chiffre_affaires }}</div>
                        </div>
                        @empty
                        {{-- ✅ Entrepreneurs statiques comme sur la maquette --}}
                        @foreach ([
                        {{-- ✅ Image différente pour chaque profil --}}
                        ['son.jpg', 'Stéphane Obame', 'TechGabon SAS', 'Paris, France', '50 - 250 employés', 'CA : 2,1 Mds FCFA', 'sector-tech', 'Technologies'],
                        ['baoo.jpeg', 'Mireille Moubamba','AgroGreen', 'Bruxelles, Belgique', '11 - 50 employés', 'CA : 850 millions de FCFA','sector-agri', 'Agriculture'],
                        ['boaa.jpg', 'Hervé Ndong', 'Ndong Consulting', 'Montréal, Canada', '10 à 50 employés', 'CA : 1,3 Mds FCFA', 'sector-services', 'Services'],
                        ['bo.jpg', 'Laura Nguema', 'InnovHealth', 'Lyon, France', '51 à 250 employés', 'CA : 1,7 Mds FCFA', 'sector-sante', 'Santé'],
                        ['bao.jpg', 'Brice Essono', 'B.E. Industries', 'Johannesburg, Afrique du Sud','Plus de 250 emp.', 'CA : 5,6 Mds FCFA', 'sector-industrie', 'Industrie'],
                        ] as [$imageName, $nom, $co, $loc, $taille, $ca, $sectClass, $sectNom])
                        <div class="une-card">
                            <div class="une-card-top">
                                <div class="une-avatar">
                                    <img src="{{ asset('images/' . $imageName) }}" alt="{{ $nom }}" loading="lazy">
                                </div>
                                <div>
                                    <div class="une-name">{{ $nom }}</div>
                                    <div class="une-company">{{ $co }}</div>
                                </div>
                            </div>


                            <span class="une-sector {{ $sectClass }}">{{ $sectNom }}</span>
                            <div class="une-meta">
                                <div class="une-meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $loc }}
                                </div>
                                <div class="une-meta-row">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg>
                                    {{ $taille }}
                                </div>
                            </div>
                            <div class="une-ca">{{ $ca }}</div>
                        </div>
                        @endforeach
                        @endforelse
                    </div>
                    <button class="une-arrow" onclick="document.getElementById('une-list').scrollBy(210,0)"><svg viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6" />
                        </svg></button>
                </div>
            </div>
    </main>

    {{-- ══ SIDEBAR DROITE ══ --}}
    <aside class="right-sidebar">
        <div class="rs-block">
            <div class="rs-title">Répartition par Continent</div>
            <div class="donut-wrap">
                <div class="donut" style="background:conic-gradient(#0f284e 0% 43.9%,#2e7d32 43.9% 64.5%,#f5c518 64.5% 82.5%,#8e24aa 82.5% 93.6%,#00897b 93.6% 100%)" role="img">
                    <div class="donut-inner"></div>
                </div>
                <div class="donut-legend">
                    @foreach ([['#0f284e','Europe','1,674 (43.9%)'],['#2e7d32','Afrique','786 (20.6%)'],['#f5c518','Amériques','687 (18%)'],['#8e24aa','Asie','425 (11.1%)'],['#00897b','Océanie','239 (6.3%)']] as [$c,$l,$p])
                    <div class="donut-legend-item">
                        <div class="donut-legend-left"><span class="donut-legend-dot" style="background:{{ $c }}"></span><span class="donut-legend-label">{{ $l }}</span></div>
                        <span class="donut-legend-pct">{{ $p }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="rs-block">
            <div class="rs-title">Top 5 des Secteurs</div>
            @foreach ([['Services','1,156 (30.3%)','30.3','#0f284e'],['Technologies','964 (25.3%)','25.3','#2e7d32'],['Commerce','645 (16.9%)','16.9','#f5c518'],['Industrie','412 (10.8%)','10.8','#8e24aa'],['Agriculture','258 (6.7%)','6.7','#00897b']] as [$nom,$nums,$pct,$color])
            <div class="secteur-item">
                <div class="secteur-header"><span class="secteur-name">{{ $nom }}</span><span class="secteur-nums">{{ $nums }}</span></div>
                <div class="secteur-bar-bg">
                    <div class="secteur-bar-fill" style="width:{{ $pct }}%;background:{{ $color }}"></div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="rs-block">
            <div class="rs-title">Répartition par Capacité Économique</div>
            <div class="donut-wrap">
                <div class="donut" style="background:conic-gradient(#0f284e 0% 28.6%,#2e7d32 28.6% 61.6%,#f5c518 61.6% 88.7%,#8e24aa 88.7% 100%)" role="img">
                    <div class="donut-inner"></div>
                </div>
                <div class="donut-legend">
                    @foreach ([['#0f284e','Émergente','1,089 (28.6%)'],['#2e7d32','En croissance','1,256 (33%)'],['#f5c518','Établie','1,034 (27.1%)'],['#8e24aa','Leader','432 (11.3%)']] as [$c,$l,$p])
                    <div class="donut-legend-item">
                        <div class="donut-legend-left"><span class="donut-legend-dot" style="background:{{ $c }}"></span><span class="donut-legend-label">{{ $l }}</span></div>
                        <span class="donut-legend-pct">{{ $p }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </aside>

</div>{{-- /.page-layout --}}

{{-- ══ INDICATEURS BAS ══ --}}
<div class="indicators-bar">
    <div class="indicator-aside">
        <div class="indicator-aside-title">Évolution des indicateurs clés</div>
        <select class="indicator-aside-select">
            <option>Année 2026</option>
            <option>Année 2025</option>
            <option>Année 2024</option>
            <option>Année 2023</option>
        </select>
    </div>
    <div class="indicators-list">
        @foreach ([
        ['Entrepreneurs','3 811','▲ +12,5%','#0f284e'],
        ['Entreprises','2 945','▲ +10,2%','#2e7d32'],
        ['Emplois créés','14 732','▲ +15,7%','#f5c518'],
        ["Chiffre d'aff.",'850 Mds FCFA','▲ +18,3%','#8e24aa'],
        ] as [$lbl,$num,$evol,$color])
        <div class="indicator-item">
            <div class="indicator-label">{{ $lbl }}</div>
            <div class="indicator-num">{{ $num }}</div>
            <div class="indicator-evol">{{ $evol }}</div>
            <div class="indicator-chart">
                <svg viewBox="0 0 120 28" preserveAspectRatio="none">
                    <polyline points="0,22 15,18 30,20 45,14 60,16 75,10 90,12 105,6 120,8"
                        fill="none" stroke="{{ $color }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity=".8" />
                    <linearGradient id="grad{{ $loop->index }}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="{{ $color }}" stop-opacity=".3" />
                        <stop offset="100%" stop-color="{{ $color }}" stop-opacity="0" />
                    </linearGradient>
                    <polygon points="0,22 15,18 30,20 45,14 60,16 75,10 90,12 105,6 120,8 120,28 0,28"
                        fill="url(#grad{{ $loop->index }})" />
                </svg>
            </div>
        </div>
        @endforeach
    </div>
    <div class="dl-block">
        <div class="dl-icon"><svg viewBox="0 0 24 24">
                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3" />
            </svg></div>
        <div class="dl-text">
            <p>Téléchargez le rapport complet</p>
            <span>Accédez à l'analyse détaillée des entrepreneurs de la diaspora.</span>
        </div>
        <a href="{{ route('rapports') }}" class="dl-btn">Télécharger le rapport</a>
    </div>
</div>

{{-- ══ FOOTER ══ --}}

@include('components.footer')

@push('scripts')
<script>
    function switchTab(btn, view) {
        document.querySelectorAll('.map-tab').forEach(t => {
            t.classList.remove('active');
            t.setAttribute('aria-selected', 'false');
        });
        btn.classList.add('active');
        btn.setAttribute('aria-selected', 'true');
    }
</script>
@endpush
@endsection