@extends('layouts.dashboard')
@section('content')
    <div class="pagetitle">
        <h1>صفحة الادارة</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">صفحة الادارة</li>
                <li class="breadcrumb-item"></li>



                <li class="breadcrumb-item"><a href="{{route('home')}}">الرئيسية</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">احصائيات المتابعة </h5>

                    <!-- Radar Chart -->
                    <div id="radarChart"></div>

                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#radarChart"), {
                          series: [{
                            name: 'Series 1',
                            data: [80, 50, 30, 40, 100, 20],
                          }],
                          chart: {
                            height: 350,
                            type: 'radar',
                          },
                          xaxis: {
                            categories: ['January', 'February', 'March', 'April', 'May', 'June']
                          }
                        }).render();
                      });
                    </script>
                    <!-- End Radar Chart -->

                  </div>
                </div>
              </div>

            <div class="col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">متابعة الزرع</h5>

                    <!-- Bar Chart -->
                    <div id="barChart"></div>

                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#barChart"), {
                          series: [{
                            data: [40, 43, 44, 47, 54, 80, 69, 100, 120, 18,133]
                          }],
                          chart: {
                            type: 'bar',
                            height: 350
                          },
                          plotOptions: {
                            bar: {
                              borderRadius: 4,
                              horizontal: true,
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          xaxis: {
                            categories: ['بطاطس', 'سوداني', 'طماطم', 'موز', 'قمح', 'خضار', '2سوداني ',
                              'بطاطس 2', 'بطاطس 3', 'فول', 'فصوليا'
                            ],
                          }
                        }).render();
                      });
                    </script>
                    <!-- End Bar Chart -->

                  </div>
                </div>
              </div>

        </div>
    </section>
@endsection
