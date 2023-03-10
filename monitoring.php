<?php
    require_once('config/setting.php');

    if (!$_SESSION["username"]) {
        header('Location: /labs/v4/login.php');
    }

    $hid = null;
    if (isset($_GET['hid'])) {
        $hid = $_GET['hid'];
    }

    $page = 'server';
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'include/inc.meta.php'; ?>
    <?php include 'include/inc.css.php'; ?>
    <title>Monitoring | FROG GENIUS</title>
    <style>
        .code-items {
            width: fit-content;
        }

        .code-items:hover {
            cursor: pointer;
        }

        .icon-spec {
            width: 24px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <div class="col-md-9 col-lg-10 ml-auto">
                <div class="row">
                    <div class="col-xl-11 mx-auto">
                        <div class="main-block py-5">
                            <h1 class="font-weight-bold">
                                Monitoring - <?=$hid?>
                            </h1>
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                            </p>
                            <div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'config/setting-js.php'; ?>
    <?php include 'include/inc.js.php'; ?>
    <script>
        var monitoring_data;
        var search = '';
        var _page = 1;
        var _per_page = 10;
        function copyToClipboard(elm) {
            if(document.body.createTextRange) {
                var range = document.body.createTextRange();
                range.moveToElementText(elm);
                range.select();
                document.execCommand("Copy");
                // notification('success', 'Copy to Clipboard');
            } else if(window.getSelection) {
                var selection = window.getSelection();
                var range = document.createRange();
                range.selectNodeContents(elm);
                selection.removeAllRanges();
                selection.addRange(range);
                document.execCommand("Copy");
                // notification('success', 'Copy to Clipboard');
                selection.removeAllRanges();
            }
        }

        function displayMonitoring() {
            var block = $('#data-table-monitoring');

            var html = ``;

            if (monitoring_data.length > 0) {
                for (var i = 0; i < monitoring_data.length; i++) {

                    var tagBlock = ``;
                    if (monitoring_data[i].tags.length > 0) {
                        for (var j = 0; j < monitoring_data[i].tags.length; j++) {
                            tagBlock += `
                                <label class="badge badge-pill badge-dark-soft font-weight-normal p-2 mr-1 small">`+ monitoring_data[i].tags[j] +`</label>
                            `;
                        }
                    }

                    var server_status_class = 'text-success';
                    if (monitoring_data[i].status != 'active') {
                        server_status_class = 'text-danger';
                    }

                    monitoring_data[i].networks.v4

                    var indexIP = _.findIndex(monitoring_data[i].networks.v4, function(o) { return o.type == 'public'; });
                    var ip_address = monitoring_data[i].networks.v4[indexIP].ip_address;

                    html += `
                        <tr>
                            <td>`+ monitoring_data[i].id +`</td>
                            <td>
                                <a href="server.php?server_id=`+ monitoring_data[i].id +`" title="">
                                    ` + monitoring_data[i].name + `
                                </a>
                                <div class="mt-2 f-9rem">
                                    `+ tagBlock +`
                                </div>
                            </td>
                            <td>
                                <div class="code-items" id="code-`+ monitoring_data[i].id +`">
                                    `+ ip_address +`
                                </div>
                            </td>
                            <td class="f-8rem">
                                <div>
                                    <i class="fad fa-microchip icon-spec text-info"></i> `+ monitoring_data[i].size.vcpus +` <span class="">Core</span>
                                </div>
                                <div>
                                    <i class="fad fa-memory icon-spec text-info"></i> `+ monitoring_data[i].size.memory +` <span class="">MB</span>
                                </div>
                                <div>
                                    <i class="fad fa-hdd icon-spec text-info"></i> `+ monitoring_data[i].size.disk +` <span class="">GB</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <i class="fad fa-circle `+ server_status_class +`"></i>
                            </td>
                        </tr>
                    `;
                }
            } else {
                html += `
                    <tr>
                        <td colspan="5" class="text-center text-muted">Monitoring not found.</td>
                    </tr>
                `;
            }

            block.find('tbody').html(html);
        }

        function getMonitoring(hid) {
            // var timestamp_start = Math.round((new Date()).getTime() / 1000);
            var timestamp_start = '1644386400';
            var timestamp_end = '1644429600';
            $.ajax({
                url: 'https://api.digitalocean.com/v2/monitoring/metrics/droplet/memory_available?host_id='+ hid +'&start=' + timestamp_start + '&end=' + timestamp_end,
                // url: 'https://api.digitalocean.com/v2/monitoring/alerts',
                type: "GET",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', _DIGITAL_OCEAN_PERSONAL_ACCESS_TOKEN);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                },
                success: function(data) {
                    monitoring_data = data.droplets;
                    console.log(monitoring_data);
                    // displayMonitoring();
                    // if (monitoring_data.length > 0) {
                    //     setupPagination(data.meta.total, _per_page);
                    // }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            // if (s_type == 'DigitalOcean') {
            // } else if (s_type == 'Internal') {
            //     displayMonitoring(monitoring_data_internal.data, page, per_page);
            //     setupPagination(s_type, monitoring_data_internal.total, per_page);
            // }
        }

        function loadingMonitoring() {
            // SET LOADING
            var block = $('#data-table-monitoring');
            var html = `
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="ml-1">
                            Loading...
                        </span>
                    </td>
                </tr>
            `;
            block.find('tbody').html(html);
        }

        $(document).ready(function() {
            getMonitoring('<?=$hid?>');

            $(document).on('click', '.code-items', function(event) {
                event.preventDefault();

                // $(this).attr('id', 'code-'+$(this).offset().top);

                var eleID = $(this).attr('id');
                const element = document.querySelector('#' + eleID);
                element.classList.add('animate__animated', 'animate__bounceIn');

                element.addEventListener('animationend', () => {
                    element.classList.remove('animate__animated', 'animate__bounceIn');
                });

                copyToClipboard($(this)[0]);
            });
        });
    </script>
</body>
</html>