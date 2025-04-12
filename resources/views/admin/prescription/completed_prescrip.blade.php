@extends('layouts.master')
@section('content')
    <!-- CSS -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/dist/jquery.fancybox.min.js') }}"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/dist/jquery.fancybox.css') }}"> --}}
    <!-- JavaScript -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" /> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>


    <div class="container-fluid px-4">

        <div class="card mt-4">

            <div class="card-header">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">Modal Title</h4>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <!-- modal body content -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="">Pending Withdrawals</h1>

                <div class="table-responsive text-nowrap">
                    <table id="pendingOrderDataTable" class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($p_order as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->method }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <td>
                                        <input type="number" 
                                               class="form-control commission-input" 
                                               data-order-id="{{ $order->id }}"
                                               value="0" 
                                               min="0"
                                               onchange="calculateTotal(this)">
                                    </td>
                                    <td class="total-amount">{{ $order->amount }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->date }}</td>
                                    <td>
                                        <a href="{{ route('admin.approve-withdrawal', $order->id) }}" class="btn btn-success btn-sm">Approve</a>
                                        <a href="{{ route('admin.reject-withdrawal', $order->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this withdrawal?')">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <style>
        .user-info {
            margin: 0 auto;
            max-width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 0 0 10px 0;
        }

        .user-info p {
            font-size: 14px;
            margin-bottom: 0px;
        }

        .user-info .id {
            color: #888;
        }

        .user-info .mobile {
            font-weight: bold;
        }

        .pres-info {
            margin: 0 auto;
            max-width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 0 0 20px 0;
        }

        .pres-info p {
            font-size: 14px;
            margin-bottom: 0px;
        }


        /* Image Slider Section */
    .image-slider-container {
        display: flex;
        justify-content: flex-end;
    }

    .swiper-container {
        position: relative;
    }

    .swiper-button-prev,
    .swiper-button-next,
    .swiper-pagination-bullet {
        color: #696cff !important;
    }

    .swiper-pagination-bullet-active {
        background: #696cff !important;
    }

    /* Image Slider Section */

    .containers {
        width: 100%;
        height: 250px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-align: right;
    }

    .label {
        width: 100px;

        float: right;
        font-weight: bold;
    }

    .values {
        width: 80px;
        float: right;
    }

    .line {
        width: 100%;
        border-top: 1px solid #ccc;
        margin: 20px 0;
        align-self: flex-end;
    }

    .confirm-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .spacer {
        flex-grow: 1;
    }

    .after-meal {
        color: blue;
    }

    .before-meal {
        color: green;
    }

    .commission-input {
        width: 100px;
        display: inline-block;
    }
    .total-amount {
        font-weight: bold;
    }

    </style>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prescription Order Preivew</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="user-info">

                        <p class="id" id="order_id">ID: ----</p>
                        <p id="fname">Name: ----e</p>
                        <p class="mobile" id="usernumber">Mobile Number: ----</p>

                    </div>

                    <!-- <div class="pres-info">
                        <p class="doc_name" id="doc_name">Doctor Name : ----</p>
                        <p class="dept" id="dept">Department : ----</p>
                        <p class="hospital" id="hospital">Hospital : ----</p>
                    </div> -->

                    <div id="group-image">
                        <div class="images">

                        </div>
                    </div>

                    <div id="cart-section">
                    <div class="card"  style="padding: 0 10px">
                    <div class="row row-bordered">

                        <div class="col-md-8">
                            <h3 style="padding: 20px 0; text-align: center; border-bottom: 1px solid #ccc;">Cart</h3>

                            <div class="card">

                                <div class="table-wrapper">
                                    <table class="table" id="cart-table">
                                        <thead>
                                            <tr>
                                                {{-- <th>Items</th>
                                                <th>Q</th>
                                                <th>Days</th>
                                                <th>Times in a day</th>
                                                <th>Number of pieses</th>
                                                <th>Instruction</th>
                                                <th>price</th> --}}

                                                <th>Items</th>
                                                {{-- <th>Type</th> --}}
                                                <th>Q</th>
                                                <th>Days</th>
                                                <th>Times in a day</th>
                                                <th>Number of pieses</th>
                                                <th>Timing</th>
                                                {{-- <th>Instruction</th> --}}
                                                <th>notes</th>
                                                <th>price</th>

                                                <!-- <th>Action</th> -->

                                            </tr>
                                        </thead>

                                        <tbody class="table-border-bottom-0">
                                        </tbody>
                                    </table>
                                </div>
                                {{-- </div> --}}
                            </div>
                            <h3 style="padding: 10px;  border-bottom: 1px solid #ccc;"></h3>

                            <div class="containers">
                                <div class="sub-container">
                                    <div class="values" id="idSubtotal">0¥</div>
                                    <div class="label">Sub-total:</div>
                                </div>
                                <div class="sub-container">
                                    <div class="values">
                                        <input type="number" id="commission" class="form-control" value="0" min="0" onchange="calculateTotal()">
                                    </div>
                                    <div class="label">Commission:</div>
                                </div>
                                <div class="Ins-container">
                                    <div class="values" id="idIns">0¥</div>
                                    <div class="label">(-) Insurance:</div>
                                </div>
                                <div class="sub-container">
                                    <div class="values" id="idTax">0¥</div>
                                    <div class="label">Tax:</div>
                                </div>
                                <div class="line"></div>
                                <div class="sub-container">
                                    <div class="values" id="idTotal">0¥</div>
                                    <div class="label">Total:</div>
                                </div>
                                <div class="spacer"></div>
                            </div>


                        </div>

                        <div class="col-md-4">
                            <h3 style="padding: 20px 0; text-align: center; border-bottom: 1px solid #ccc;">Prescriptions
                            </h3>

                            <div class="image-slider-container">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">

                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>



                            <!-- <h5 style="padding: 5px 0; text-align: center; border-bottom: 1px solid #ccc; margin-top:15px">
                                Insurance Card
                            </h5>

                            <div class="mb-3" style="margin-right: 10px">

                                <div style="padding: 5px; margin: 0 0 25px 0"> <label for="card-number"
                                        style="float: left;">Card No.</label>

                                    <input class="form-check-input" type="checkbox" id="verify_tik" style="float: right;">
                                    <label for="verified" style="float: right; margin-right:10px;">Verified</label>
                                </div>
                                <input type="text" name="ins_code" id="ins_code"
                                    class="form-control"placeholder="Enter Card No.">

                            </div>

                            <h5 style="padding: 5px 0; text-align: center; border-bottom: 1px solid #ccc; margin-top:15px">
                                Order Basic Info
                            </h5>
                            <div class="mb-3" style="margin-right: 10px">
                                <div style="padding: 5px; margin: 10px 0 0 0">
                                    <label for="hospital" style="float: left;">Hospital Name</label>
                                </div>
                                <input type="text" name="hospital" id="hospital"
                                    class="form-control"placeholder="Enter Hospital Name.">
                                <div style="padding: 5px; margin: 10px 0 0 0">
                                    <label for="department" style="float: left;">Department Name</label>
                                </div>
                                <input type="text" name="department" id="department"
                                    class="form-control"placeholder="Enter Department Name">
                                <div style="padding: 5px; margin: 10px 0 0 0">
                                    <label for="doctor_name" style="float: left;">Doctor Name</label>
                                </div>
                                <input type="text" name="doctor_name" id="doctor_name"
                                    class="form-control"placeholder="Enter Doctor Name">
                            </div> -->

                        </div>



                    </div>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


    <script>

        var mySwiper = new Swiper('.swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            // loop: true,

            // If you want to zoom in/out images
            zoom: {
                maxRatio: 5,
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Scrollbar
            scrollbar: {
                //el: '.swiper-scrollbar',
            },
        });
    </script>


    <script>



         $(document).ready(function() {
            $('#pendingOrderDataTable').DataTable({
                order: [0, 'dec'] // Sort by the first column (index 0) in descending order
            });
        });
        function confirmDelete() {
            return confirm('Are you sure you want to reject this order?');
        }

        function calculateTotal(input) {
            const orderId = input.dataset.orderId;
            const amount = parseFloat(input.closest('tr').querySelector('td:nth-child(5)').textContent);
            const commission = parseFloat(input.value) || 0;
            const total = amount + commission;
            
            input.closest('tr').querySelector('.total-amount').textContent = total.toFixed(2);
        }

        function prescription_info(order) {
            var groupImage = document.getElementById('group-image');
            var images = groupImage.querySelector('.images');
            var imgList = order.p_image.split(';');
            while (images.firstChild) {
                images.removeChild(images.firstChild);
            }
            document.getElementById('order_id').textContent = "ID : " + order.id;
            document.getElementById('fname').textContent = " Name : " + order.user.fname + " " + order.user.lname;
            document.getElementById('usernumber').textContent = "Number : " + order.user.mobile;

            // document.getElementById('doc_name').textContent = "Doctor Name  : " + order.doctor_name;
            // document.getElementById('dept').textContent = "Department : " + order.department;
            // document.getElementById('hospital').textContent = "Hospital : " + order.hospital;


            document.getElementById("idSubtotal").innerText = order.subtotal + "¥";
            document.getElementById("idIns").innerText = order.insurance_total + "¥";
            document.getElementById("idTax").innerText = order.tax + "¥";
            
            // Calculate initial total
            calculateTotal();

            imgList.forEach(function(imgSrc) {
                var imgLink = document.createElement('a');
                imgLink.href = "{{ url('') }}/" + imgSrc;
                imgLink.setAttribute('data-fancybox', 'gallery');
                imgLink.style.margin = "10px";
                var img = document.createElement('img');
                img.src = "{{ url('') }}/" + imgSrc;
                img.style.width = '250px';
                imgLink.appendChild(img);
                images.appendChild(imgLink);
            });


            var swiperWrapper = document.querySelector('.swiper-wrapper');

                // Clear the existing contents of swiper-wrapper
    swiperWrapper.innerHTML = '';

// Loop through the imgList and create HTML elements for each image
imgList.forEach(function(imgPath) {
    var swiperSlide = document.createElement('div');
    swiperSlide.classList.add('swiper-slide');

    var link = document.createElement('a');
    link.href = "{{ url('') }}/" + imgPath;
    link.setAttribute('data-fancybox', 'gallery');
    // link.setAttribute('href', imgPath);

    var image = document.createElement('img');

    image.src = "{{ url('') }}/" + imgPath;
    image.style.width = '100%';



    link.appendChild(image);
    swiperSlide.appendChild(link);
    swiperWrapper.appendChild(swiperSlide);
});

var order_id = order.id;

        $.ajax({
            url: "{{ route('orderdetails') }}",
            type: 'GET',
            data: {order_id: order_id},
            success: function(response) {
                console.log(response);

                var tbody = document.querySelector('#cart-table tbody');

    tbody.innerHTML = '';


    for (var i = 0; i < response.length; i++) {
        var row = document.createElement('tr');


        var titleCell = document.createElement('td');
        titleCell.textContent = response[i].m_title;
        row.appendChild(titleCell);

        // var typesCell = document.createElement("td");
        //         typesCell.textContent = response[i].m_types;
        //         typesCell.style.whiteSpace = "nowrap";
        //         row.appendChild(typesCell);

        var quantityCell = document.createElement('td');
        quantityCell.textContent = response[i].quantity;
        row.appendChild(quantityCell);

        var daysCell = document.createElement('td');
        daysCell.textContent = response[i].m_days;
        row.appendChild(daysCell);

        var doseCell = document.createElement('td');
        doseCell.textContent = response[i].m_daily_dose;
        row.appendChild(doseCell);

        var piecesCell = document.createElement('td');
        piecesCell.textContent = response[i].m_piese_per_dose;
        row.appendChild(piecesCell);

        var instructionCell = document.createElement('td');

        if (response[i].m_instruction === 0) {
                    instructionCell.classList.add('after-meal');
                    instructionCell.textContent = "After Meal";
                } else if (response[i].m_instruction === 1) {
                    instructionCell.classList.add('before-meal');
                    instructionCell.textContent = "Before Meal";
                }
        row.appendChild(instructionCell);

        // var menuCell = document.createElement("td");
        //         menuCell.textContent = response[i].m_times;
        //         menuCell.style.whiteSpace = "nowrap";
        //         row.appendChild(menuCell);

                var notesCell = document.createElement("td");
                // var notesText = response[i].notes;
                var notesText = response[i].m_notes;
                var truncatedText = "";
                if (notesText) {
                    truncatedText = notesText.length > 6 ? notesText.slice(0, 6) + '...' : notesText;
                }
                notesCell.textContent = truncatedText;
                // notesCell.textContent = item.notes;
                notesCell.style.whiteSpace = "nowrap";
                row.appendChild(notesCell);


        var priceCell = document.createElement('td');
        priceCell.textContent = response[i].tottal_price;
        row.appendChild(priceCell);

        // Append the row to the tbody
        tbody.appendChild(row);
    }
            },
            error: function(xhr) {
                // Handle any errors
                console.log(xhr.responseText);
            }
        });


            if (order.cart_status == 2) {
                document.getElementById("cart-section").style.display = "block";
                document.getElementById("group-image").style.display = "none";

            }
            else if (order.cart_status == 1) {
                document.getElementById("cart-section").style.display = "block";
                document.getElementById("group-image").style.display = "none";

            }
            else {
                document.getElementById("cart-section").style.display = "none";
                document.getElementById("group-image").style.display = "block";

            }


            $('.images a').fancybox({
                // Set the options for Fancybox
                buttons: [
                    'zoom',
                    // 'slideShow',
                    'fullScreen',
                    'thumbs',
                    'close'
                ],
                animationEffect: "fade",
                transitionEffect: "slide",
                loop: true,
                clickContent: true,
                afterLoad: function(instance, current) {
                    // Set the z-index of the Fancybox container
                    $(current.$content).css('z-index', 99999);
                }
            });



        }
    </script>
    <script></script>

    <style>
        .image-slider-container {
            overflow: hidden;
        }

        .image-slider-container .swiper-container {
            /* position: absolute; */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

        }

        .image-slider-container .swiper-slide img {

            padding: 0px 20px 5px 5px;
            width: 50%;
            height: 100%;


        }

        .form-control {
            width: 80px;
            display: inline-block;
            margin-left: 5px;
        }
        .values input {
            text-align: right;
        }
    </style>
@endsection
