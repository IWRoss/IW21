<?php



?>

<div id="<?php echo $block['id']; ?>" class="iw-block iw-amp alignwide">

    <div class="iw-amp-element" style="background-image:url('<?php the_field('image'); ?>');">
        <canvas id="amp-radar" data-results=<?php echo iw21_array_key_exists('results', $_GET) ? base64_decode($_GET['results']) : ''; ?> width="492" height="492"></canvas>
    </div>
</div>

<script>
    var ctx = document.getElementById("amp-radar").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "radar",
        data: {
            labels: [
                ["Brain Mode"],
                ["Behavioral", "Awareness"],
                ["Proactivity"],
                ["Trustworthiness"],
                ["Mindset"],
                ["Direction"],
                ["Message", "Communication"],
                ["Wins"],
                ["Extending", "Trust"],
                ["Relationships"],
                ["Standards"],
                ["Encouragement"],
                ["Scheduling"],
                ["Goals"],
                ["Focus"],
                ["Celebration"]
            ],
            datasets: [{
                label: "Results",
                data: JSON.parse(document.getElementById('amp-radar').dataset.results),
                tension: 0.25,
                fill: true,
                backgroundColor: "rgba(0,188,235, 0.2)",
                borderColor: "rgb(0,188,235)",
                pointBackgroundColor: "rgb(0,188,235)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgb(0,188,235)"
            }]
        },
        options: {
            responsive: false,
            scales: {
                rAxis: {
                    min: 1,
                    max: 5,
                    startAngle: 11.25,
                    angleLines: {
                        display: false,
                        color: "rgba(54, 162, 235, 0.4)"
                    },
                    ticks: {
                        display: false,
                        stepSize: 1,
                        color: "rgba(54, 162, 235, 0.7)",
                        backdropColor: "#000000",
                        font: {
                            size: 14
                        }
                    },
                    grid: {
                        display: false,
                        color: "rgba(54, 162, 235, 0.4)",
                        circular: true,
                        offset: true
                    },
                    pointLabels: {
                        display: false,
                        color: "rgba(54, 162, 235, 0.7)",
                        font: {
                            family: "Helvetica Neue, Helvetica, Arial, sans-serif",
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                    position: "bottom",
                    labels: {
                        font: {
                            family: "Helvetica Neue, Helvetica, Arial, sans-serif",
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

<style>
    .iw-amp-element {
        position: relative;
        width: 960px;
        height: 742px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    #amp-radar {
        display: block;
        position: absolute;
        left: 234px;
        top: 125px;
    }
</style>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>