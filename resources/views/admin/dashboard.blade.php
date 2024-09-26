@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- UMKM Card -->
                        <div class="col-xxl-4 col-md-6 col-lg-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">UMKM</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-shop"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $countBusiness }}</h6>
                                            <a href="{{ route('admin.business') }}">
                                                <span class="text-primary small pt-1 fw-bold">Lihat detail <i
                                                        class="bi bi-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End UMKM Card -->

                        <!-- Produk Card -->
                        <div class="col-xxl-4 col-md-6 col-lg-4">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Produk</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bag"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $countProduct }}</h6>
                                            <a href="{{ route('admin.products') }}">
                                                <span class="text-primary small pt-1 fw-bold">Lihat detail <i
                                                        class="bi bi-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Produk Card -->

                        <!-- Iklan Card -->
                        <div class="col-xxl-4 col-md-6 col-lg-4">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Iklan</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-badge-ad"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $countAd }}</h6>
                                            <a href="{{ route('admin.advertisements') }}">
                                                <span class="text-primary small pt-1 fw-bold">Lihat detail <i
                                                        class="bi bi-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Iklan Card -->

                    </div>
                </div><!-- End Left side columns -->

                <div class="col-lg-12">
                    <div class="row">
                        {{-- Produk Per Jenis --}}
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Produk Per Jenis</h5>

                                    <!-- Pie Chart -->
                                    <div id="pieChart" style="min-height: 400px;" class="echart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const getProductCountsByType = @json($getProductCountsByType);

                                            echarts.init(document.querySelector("#pieChart")).setOption({
                                                title: {
                                                    text: 'Jumlah Produk Per Jenis',
                                                    subtext: 'Data berdasarkan jenis produk',
                                                    left: 'center'
                                                },
                                                tooltip: {
                                                    trigger: 'item'
                                                },
                                                legend: {
                                                    orient: 'vertical',
                                                    left: 'left'
                                                },
                                                series: [{
                                                    name: 'Jumlah Produk',
                                                    type: 'pie',
                                                    radius: '50%',
                                                    data: getProductCountsByType,
                                                    emphasis: {
                                                        itemStyle: {
                                                            shadowBlur: 10,
                                                            shadowOffsetX: 0,
                                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                        }
                                                    }
                                                }]
                                            });
                                        });
                                    </script>
                                    <!-- End Pie Chart -->

                                </div>
                            </div>
                        </div>
                        {{-- End Produk Per Jenis --}}

                        {{-- UMKM Per Kalurahan --}}
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">UMKM Per Kalurahan</h5>

                                    <!-- Bar Chart -->
                                    <div id="barChart" style="min-height: 400px;" class="echart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const getBusinessCountsBySubDistrict = @json($getBusinessCountsBySubDistrict);

                                            const categories = getBusinessCountsBySubDistrict.map(data => data.name);
                                            const values = getBusinessCountsBySubDistrict.map(data => data.value);

                                            echarts.init(document.querySelector("#barChart")).setOption({
                                                xAxis: {
                                                    type: 'category',
                                                    data: categories
                                                },
                                                yAxis: {
                                                    type: 'value'
                                                },
                                                series: [{
                                                    data: values,
                                                    type: 'bar'
                                                }]
                                            });
                                        });
                                    </script>
                                    <!-- End Bar Chart -->

                                </div>
                            </div>
                        </div>
                        {{-- End UMKM Per Kalurahan --}}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
