<?php
    require_once('config/setting.php');

?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'include/inc.meta.php'; ?>
    <?php include 'include/inc.css.php'; ?>
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->

    <title>Server | FROG GENIUS</title>
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
    <div class="container-fluid" style="padding-left:0;">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <div class="col-md-9 col-lg-10 ml-auto">
                <div class="row">
                    <div class="col-xl-11 mx-auto">
                        <div class="main-block py-5">
                            <h1 class="font-weight-bold">
                                Server
                            </h1>
                            <p class="text-muted">
                                <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. -->
                            </p>
                            <div class="p-3 bg-light rounded mb-3">
                                <form id="form-server" action="">
                                    <input id="tag_name" type="text" class="form-control" name="tag_name" placeholder="Search project">
                                </form>
                            </div>
                            <div>
                                <table id="data-table-server" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">IP Address</th>
                                            <th class="border-top-0" width="12%">Spec</th>
                                            <th class="border-top-0 text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <strong id="server-total">0</strong> items
                                            </td>
                                            <td colspan="3">
                                                <nav>
                                                    <ul class="pagination pagination-server justify-content-end mb-0"></ul>
                                                </nav>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
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
        var server_data;
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

        function displayServer() {
            var block = $('#data-table-server');

            var html = ``;

            if (server_data.length > 0) {
                for (var i = 0; i < server_data.length; i++) {

                    var tagBlock = ``;
                    if (server_data[i].tags.length > 0) {
                        for (var j = 0; j < server_data[i].tags.length; j++) {
                            tagBlock += `
                                <label class="badge badge-pill badge-dark-soft font-weight-normal p-2 mr-1 small">`+ server_data[i].tags[j] +`</label>
                            `;
                        }
                    }

                    var server_status_class = 'text-success';
                    if (server_data[i].status != 'active') {
                        server_status_class = 'text-danger';
                    }

                    server_data[i].networks.v4

                    var indexIP = _.findIndex(server_data[i].networks.v4, function(o) { return o.type == 'public'; });
                    var ip_address = server_data[i].networks.v4[indexIP].ip_address;

                    html += `
                        <tr>
                            <td>`+ server_data[i].id +`</td>
                            <td>
                                <a href="server.php?server_id=`+ server_data[i].id +`" title="">
                                    ` + server_data[i].name + `
                                </a>
                                <div class="mt-2 f-9rem">
                                    `+ tagBlock +`
                                </div>
                            </td>
                            <td>
                                <div class="code-items" id="code-`+ server_data[i].id +`">
                                    `+ ip_address +`
                                </div>
                            </td>
                            <td class="f-8rem">
                                <div>
                                    <i class="fad fa-microchip icon-spec text-info"></i> `+ server_data[i].size.vcpus +` <span class="">Core</span>
                                </div>
                                <div>
                                    <i class="fad fa-memory icon-spec text-info"></i> `+ server_data[i].size.memory +` <span class="">MB</span>
                                </div>
                                <div>
                                    <i class="fad fa-hdd icon-spec text-info"></i> `+ server_data[i].size.disk +` <span class="">GB</span>
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
                        <td colspan="5" class="text-center text-muted">Server not found.</td>
                    </tr>
                `;
            }

            block.find('tbody').html(html);
        }

        function getServer(page, per_page, search) {
            $.ajax({
                url: 'https://api.digitalocean.com/v2/droplets?page='+ page +'&per_page=' + per_page + '&tag_name=' + search,
                type: "GET",
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', _DIGITAL_OCEAN_PERSONAL_ACCESS_TOKEN);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                },
                success: function(data) {
                    server_data = data.droplets;
                    console.log(server_data);
                    displayServer();
                    if (server_data.length > 0) {
                        setupPagination(data.meta.total, _per_page);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
            // if (s_type == 'DigitalOcean') {
            // } else if (s_type == 'Internal') {
            //     displayServer(server_data_internal.data, page, per_page);
            //     setupPagination(s_type, server_data_internal.total, per_page);
            // }
        }

        function setupPagination(total, per_page) {
            $('#server-total').text(total);

            var totalPages = Math.ceil(total / per_page);

            $('.pagination-server').twbsPagination({
                totalPages: totalPages,
                visiblePages: 4,
                startPage: _page,
                first: '<i class="far fa-angle-double-left"></i>',
                last: '<i class="far fa-angle-double-right"></i>',
                prev: '<i class="far fa-angle-left"></i>',
                next: '<i class="far fa-angle-right"></i>',
                onPageClick: function (event, page) {
                    if (_page != page) {
                        _page = page;
                        loadingServer();
                        getServer(_page, _per_page, '');
                    }
                }
            });
        }

        function loadingServer() {
            // SET LOADING
            var block = $('#data-table-server');
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
            getServer(1, _per_page, search);

            $('#form-server').on('submit', function(event) {
                event.preventDefault();

                loadingServer();

                var tag_name = $('#tag_name').val();
                getServer(1, 10, tag_name);
            });

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