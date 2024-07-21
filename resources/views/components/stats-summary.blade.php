<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <section class="py-12">
            <x-dashboard-title>Analytics</x-dashboard-title>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold mb-4">Views Over Time</h2>
                    <canvas id="viewsChart"></canvas>
                </div>
                <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold mb-4">Top Posts</h2>
                    <canvas id="topPostsChart"></canvas>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
          var darkThemeOptions = {
        responsive: true,
        scales: {
             beginAtZero: true,
            x: {
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0)'
                }
            },
            y: {
                ticks: {
                    color: 'rgba(255, 255, 255, 0.7)',
                maxTicksLimit: 5,
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0)'
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: 'rgba(255, 255, 255, 0.7)'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                titleColor: 'rgba(255, 255, 255, 0.9)',
                bodyColor: 'rgba(255, 255, 255, 0.9)',
                borderColor: 'rgba(255, 255, 255, 0.3)',
                borderWidth: 1
            }
        }
    };
        // Views Over Time Chart
        var ctx1 = document.getElementById('viewsChart').getContext('2d');
        var viewsChart = new Chart(ctx1, {
            type: 'line'
            , data: {
                labels: {!!json_encode($viewsOverTime['labels'])!!}
                , datasets: [{
                    label: 'Views'
                    , data: {!!json_encode($viewsOverTime['data'])!!}
                    , borderColor: 'rgba(75, 192, 192, 1)'
                    , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                    , fill: true
                , }]
            }
            , options: darkThemeOptions
        });

        // Top Posts Chart
        var ctx2 = document.getElementById('topPostsChart').getContext('2d');
        var topPostsChart = new Chart(ctx2, {
            type: 'bar'
            , data: {
                labels: JSON.parse('{!!json_encode($topPosts['labels']) !!}')
                , datasets: [{
                    label: 'Views'
                    , data: {!!json_encode($topPosts['data']) !!}
                    , backgroundColor: 'rgba(153, 102, 255, 0.2)'
                    , borderColor: 'rgba(153, 102, 255, 1)'
                    , borderWidth: 1
                }]
            }
            , options: {
                responsive: true
                , scales: {
                    x: {
                        beginAtZero: true,
                         ticks: {
                    color: 'rgba(255, 255, 255, 0.7)',

                },
                grid: {
                    color: 'rgba(255, 255, 255, 0)'
                }
                    , }
                    , y: {
                        beginAtZero: true,
                         ticks: {
                    color: 'rgba(255, 255, 255, 0.7)',
                maxTicksLimit: 5,

                },
                grid: {
                    color: 'rgba(255, 255, 255, 0)'
                }
                    , }
                }
            }
        });
    });

</script>
