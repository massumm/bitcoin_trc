@extends('layouts.master')

<!-- CSS -->
{{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

<!-- JavaScript -->
{{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



<style>
    .after {
        color: blue;
    }

    .before {
        color: green;
    }

    .any {
        color: palevioletred;
    }

    /* datatavle section */
    .dataTables_wrapper .dataTables_length {
        display: none;
    }

    .dataTables_info {
        display: none;
    }

    /* datatavle section */

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

    /*Cart  table Section */
    .table-wrapper {
        max-width: 500px;
        overflow-x: auto;
    }

    .table {
        font-size: 14px;
        /* set a smaller font size */
    }


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
        width: 70%;
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

    /*Cart  table Section */

    /*Cart popup Section */

    .form-popup-inputs {
        margin-top: 15px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .form-popup-inputs label {
        margin-right: 10px;
        min-width: 150;
    }

    .form-select {
        margin-top: 10px;
    }

    .form-check {
        width: 80px;
        align-items: left;
    }

    .form-price {
        text-align: right;
    }

    .form-price label {

        margin-right: 10px;
        font-size: 20px;
    }

    /*Cart popup Section */


    .fancybox-button--arrow_left,
    .fancybox-button--arrow_right {
        display: none !important;
    }
</style>

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered">
                        <div class="col-md-4">

                            <div style="margin: 20px;">
                                <table id="medicineDataTable" class="table" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Product List</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0">
                                        @foreach ($medicineListModel as $item)
                                            <tr>

                                                <td>
                                                    <div style="display: flex; align-items: start;">
                                                        <div style="margin-right: 10px;">
                                                            <img src="{{ asset($item->image) }}" width="50px"
                                                                height="50px" alt="Img">
                                                        </div>
                                                        <div>
                                                            <div style="font-weight: bold;">{{ $item->title }}</div>
                                                            <div style="color: gray;">{{ $item->type }}</div>
                                                            <div>
                                                                Price: {{ $item->price }}¥
                                                            </div>
                                                            {{-- <div>
                                                                Discount: {{ $item->discount }}¥
                                                            </div> --}}
                                                            <div>
                                                                @if ($item->stock_status == 1)
                                                                    <span style="color: green;">In Stock</span>
                                                                @else
                                                                    <span style="color: red;">Out of Stock</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div style="margin-left: auto; display: flex; align-items: center;">
                                                            <div>
                                                                <button
                                                                    onclick="addClick( {{ $item->id }}, '{{ $item->title }}', '{{ $item->type }}', '{{ $item->image }}',  {{ $item->price }}, {{ $item->daily_dose }},  {{ $item->piese_per_dose }},  {{ $item->instruction }},  {{ $item->stock_status }})"
                                                                    {{-- data-bs-toggle="modal" --}} class="btn btn-primary"
                                                                    style="padding: 5px 5px;">
                                                                    <i class="fa fa-shopping-cart"
                                                                        style="margin-right: 5px;"></i> Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <h3 style="padding: 20px 0; text-align: center; border-bottom: 1px solid #ccc;">Cart</h3>

                            <div class="card">
                                {{-- <div class="table-responsive text-nowrap"> --}}
                                <div class="table-wrapper">
                                    <table class="table" id="cart-table">
                                        <thead>
                                            <tr>
                                                <th>Items</th>
                                                <th>Type</th>
                                                <th>Q</th>
                                                <th>Days</th>
                                                <th>Times in a day</th>
                                                <th>Number of pieses</th>
                                                <th>Timing</th>
                                                <th>Instruction</th>
                                                <th>notes</th>
                                                <th>price</th>
                                                <th>Action</th>

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
                                <button onclick="confirm()" class="confirm-btn">Confirm</button>
                            </div>


                        </div>

                        <div class="col-md-3">
                            <h3 style="padding: 20px 0; text-align: center; border-bottom: 1px solid #ccc;">Prescriptions
                            </h3>

                            <div class="image-slider-container">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php
                                            $imglist = explode(';', $PrescriptionOrderId->p_image);
                                            foreach($imglist as $vlist) {
                                        ?>
                                        <div class="swiper-slide">
                                            <a data-fancybox="gallery" href="{{ asset($vlist) }}">
                                                <img src="{{ asset($vlist) }}" />
                                            </a>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>



                            <h5 style="padding: 5px 0; text-align: center; border-bottom: 1px solid #ccc; margin-top:15px">
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
                            </div>

                        </div>



                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Medicine to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group text-right">
                        <label><b class="font-weight-bold" id="Medicine-title">Medicine Name</b></label>
                    </div>

                    <h3 style="padding: 10px;  border-bottom: 1px solid #ccc;"></h3>

                    <div class="form-popup-inputs">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" value="1" min="1"
                            oninput="quantityChanged()">
                    </div>

                    <div class="form-popup-inputs">
                        <label for="days">Days:</label>
                        <input type="number" class="form-control" id="days" value="1" min="1">

                    </div>

                    <div class="form-popup-inputs">
                        <label for="daily_dose">Times in a Day :</label>
                        <input type="number" class="form-control" id="daily_dose" value="1" min="1">

                    </div>

                    <div class="form-popup-inputs">
                        <label for="piese_per_dose">Number of Pieses :</label>
                        <input type="number" class="form-control" id="piese_per_dose" value="1" min="1">

                    </div>

                    <div class="form-popup-inputs">
                        <label for="instruction">Instruction :</label>

                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="defaultRadio1" checked="">
                            <label class="form-check-label" for="defaultRadio1"> After </label>
                        </div>

                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="defaultRadio2">
                            <label class="form-check-label" for="defaultRadio2"> Before </label>
                        </div>


                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="defaultRadio3">
                            <label class="form-check-label" for="defaultRadio3"> Any </label>
                        </div>

                    </div>

                    <select class="form-select" id="selectTimes" aria-label="SelectMeal">
                        <option selected="">Select Timings</option>
                        <option value="1">Breakfast</option>
                        <option value="2">Lunch</option>
                        <option value="3">Dinner</option>
                        <option value="4">Sleep</option>
                        <option value="5">Breakfast/ Lunch</option>
                        <option value="6">Breakfast/ Dinner</option>
                        <option value="7">Lunch/ Dinner</option>
                        <option value="8">Breakfast/ Lunch/ Dinner</option>
                        <option value="9">8 hour</option>
                        <option value="10">4 hour</option>
                    </select>

                    <div class="form-popup-inputs">
                        <label for="addNote">Add Note :</label>
                    </div>
                    {{-- <textarea class="form-control" id="addNote" rows="2"></textarea> --}}
                    <input type="text" class="form-control" id="addNote">

                    <h3 style="padding: 10px;  border-bottom: 1px solid #ccc;"></h3>

                    <div class="form-price">
                        <label><b class="font-weight-bold" id="price">Price:</b></label>
                        <label id="price-value" for="price">2000¥</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    {{-- <button onclick="addtoCart()" type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        id="addToCart">Add to Cart</button> --}}
                    <button onclick="addtoCart()" type="button" class="btn btn-primary" id="addToCart">Add to
                        Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!--edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Medicine Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group text-right">
                        <label><b class="font-weight-bold" id="medi_title">Medicine Name</b></label>
                    </div>

                    <h3 style="padding: 10px;  border-bottom: 1px solid #ccc;"></h3>

                    <div class="form-popup-inputs">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="edit-quantity" value="1" min="1"
                        oninput="editquantityChanged()">

                    </div>
                    <div class="form-popup-inputs">
                        <label for="days">Days:</label>
                        <input type="number" class="form-control" id="edit-days" value="1" min="1">

                    </div>


                    <div class="form-popup-inputs">
                        <label for="daily_dose">Times in a Day :</label>
                        <input type="number" class="form-control" id="edit_daily_dose" value="1" min="1">

                    </div>

                    <div class="form-popup-inputs">
                        <label for="piese_per_dose">Number of Pieses :</label>
                        <input type="number" class="form-control" id="edit_piese_per_dose" value="1"
                            min="1">

                    </div>

                    <div class="form-popup-inputs">
                        <label for="instruction">Instruction :</label>

                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="edit_defaultRadio1" checked="">
                            <label class="form-check-label" for="edit_defaultRadio1"> After </label>
                        </div>

                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="edit_defaultRadio2">
                            <label class="form-check-label" for="edit_defaultRadio2"> Before </label>
                        </div>

                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                id="edit_defaultRadio3">
                            <label class="form-check-label" for="edit_defaultRadio3"> Any </label>
                        </div>

                    </div>

                    <select class="form-select" id="edit_selectTimes" aria-label="SelectMeal">
                        <option selected="">Select Timings</option>
                        <option value="1">Breakfast</option>
                        <option value="2">Lunch</option>
                        <option value="3">Dinner</option>
                        <option value="4">Sleep</option>
                        <option value="5">Breakfast/ Lunch</option>
                        <option value="6">Breakfast/ Dinner</option>
                        <option value="7">Lunch/ Dinner</option>
                        <option value="8">Breakfast/ Lunch/ Dinner</option>
                        <option value="9">8 hour</option>
                        <option value="10">4 hour</option>
                    </select>

                    <div class="form-popup-inputs">
                        <label for="addNote">Add Note :</label>
                    </div>

                    <input type="text" class="form-control" id="edit_addNotes">

                    <h3 style="padding: 10px;  border-bottom: 1px solid #ccc;"></h3>

                    <div class="form-price">
                        <label><b class="font-weight-bold" id="price">Price:</b></label>
                        <label id="edit-price-value" for="price">2000¥</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="updateCart()" type="button" class="btn btn-primary" id="updateCart">Add to
                        Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!--exist Modal -->
    <div class="modal fade" id="existModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">This item already exists in your cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please remove the item currently in your cart before adding it again, or edit the existing item.
                </div>
            </div>
        </div>
    </div>

    <!--outOfStock Modal -->
    <div class="modal fade" id="outOfStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Out of stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This item is out of stock.
                </div>
            </div>
        </div>
    </div>

    <!--fieldsEmptyModal -->
    <div class="modal fade" id="fieldsEmptyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Some fields are empty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="fieldsEmptyModalLabel">
                    Some fields are epmty
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#medicineDataTable').DataTable({
                order: [0, 'asc'] // Sort by the first column (index 0) in ascending order
            });
        });

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
        const checkbox = document.getElementById("verify_tik");

        var items = [];

        var subtotal = 0.0;
        var tax = 0.0;
        var total = 0.0;

        var insCode = "";
        var insTotal = 0.0;
        var hospital = "";
        var department = "";
        var doctor_name = "";

        var goForUpload = false;

        var orderDetailsModel = "{{ $orderDetailsModel }}";
        var PrescriptionOrderId = "{{ $PrescriptionOrderId }}";
        // var prescriptionModel = "{{ $PrescriptionOrderId }}";
        var orderDetails = JSON.parse(orderDetailsModel.replace(/&quot;/g, '"'));
        console.log(orderDetails);
        var PrescriptionOrderDetails = JSON.parse(PrescriptionOrderId.replace(/&quot;/g, '"'));
        console.log(PrescriptionOrderDetails);
        getCartData();



        function getCartData() {

            console.log(PrescriptionOrderDetails.ins_code);
            console.log("incode");
            if (PrescriptionOrderDetails.ins_code != "" && PrescriptionOrderDetails.ins_code != null) {

                console.log("incode if");
                console.log(PrescriptionOrderDetails.ins_code);

                document.getElementById('verify_tik').checked = true;
                document.getElementById("ins_code").value = PrescriptionOrderDetails.ins_code;
            } else if (PrescriptionOrderDetails.ins_code == null) {
                console.log("incode else");
                console.log(PrescriptionOrderDetails.ins_code);

                document.getElementById('verify_tik').checked = false;
            }


            document.getElementById("hospital").value = PrescriptionOrderDetails.hospital;
            document.getElementById("department").value = PrescriptionOrderDetails.department;
            document.getElementById("doctor_name").value = PrescriptionOrderDetails.doctor_name;

            for (var i = 0; i < orderDetails.length; i++) {

                let newItem = {
                    id: orderDetails[i].m_id,
                    name: orderDetails[i].m_title,
                    types: orderDetails[i].m_types,
                    image: orderDetails[i].m_image,
                    quantity: parseInt(orderDetails[i].quantity),
                    days: parseInt(orderDetails[i].m_days),
                    price: orderDetails[i].tottal_price,
                    menu: orderDetails[i].m_times,
                    notes: orderDetails[i].m_notes,
                    daily_dose: parseInt(orderDetails[i].m_daily_dose),
                    piese_per_dose: parseInt(orderDetails[i].m_piese_per_dose),
                    instruction: parseInt(orderDetails[i].m_instruction)
                };
                items.push(newItem);
                showCart();
            }

            console.log(items);

        }

        var c_id = 1;
        var c_title = "";
        var c_types = "";
        var c_image = "";
        var c_price = 1;
        var c_days = 1;
        var c_quantuty = 1;
        var c_daily_dose = 1;
        var c_piese_per_dose = 1;
        var c_instruction = 0;
        var c_menu = "";
        var c_notes = "";
        var initial_price = 1;



        function addClick(id, title, types, image, price, daily_dose, piese_per_dose, instruction, stock_status) {


            var itemExists = false;

            for (var i = 0; i < items.length; i++) {
                if (items[i].id === id) {
                    itemExists = true;
                    break;
                }
            }

            if (itemExists) {

                var modal = new bootstrap.Modal(document.getElementById("existModal"));
                modal.show();

                return;

            }
            if (stock_status == 0) {

                var modal = new bootstrap.Modal(document.getElementById("outOfStock"));
                modal.show();

                return;

            } else {

                var modal = new bootstrap.Modal(document.getElementById("addModal"));
                modal.show();
            }

            console.log(id);
            console.log(title);
            console.log(price);
            console.log(daily_dose);
            console.log(piese_per_dose);
            console.log(instruction);
            c_id = id;
            c_title = title;
            c_types = types;
            c_image = image;
            c_price = price;
            c_daily_dose = daily_dose;
            c_piese_per_dose = piese_per_dose;
            c_instruction = instruction;
            c_menu = "";
            c_notes = "";
            initial_price = price;

            document.getElementById("Medicine-title").innerText = title;
            document.getElementById("price-value").innerText = price + "¥";
            document.getElementById("daily_dose").value = daily_dose;
            document.getElementById("piese_per_dose").value = piese_per_dose;

            const afterMealRadio = document.getElementById("defaultRadio1");
            const beforeMealRadio = document.getElementById("defaultRadio2");
            const anyMealRadio = document.getElementById("defaultRadio3");

            if (instruction === 0) {
                afterMealRadio.checked = true;
            } else if (instruction === 1) {
                beforeMealRadio.checked = true;
            } else if (instruction === 2) {
                anyMealRadio.checked = true;
            }


        }

        var selectElement = document.getElementById("selectTimes");

        selectElement.addEventListener("change", function() {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            // c_menu = selectElement.value;
            c_menu = selectedOption.text;


        });

        var textareaElement = document.getElementById("addNote");

        textareaElement.addEventListener("input", function() {
            var inputText = textareaElement.value;

            if (inputText.length > 30) {
                textareaElement.value = inputText.substring(0, 30);
            }
        });

        var textareaElement2 = document.getElementById("edit_addNotes");

        textareaElement2.addEventListener("input", function() {
            var inputText = textareaElement2.value;

            if (inputText.length > 30) {
                textareaElement2.value = inputText.substring(0, 30);
            }
        });

        function quantityChanged() {
            var quantity = document.getElementById("quantity").value;
            // var price = initial_price * quantity
            // document.getElementById("price-value").innerText = price + "¥";
            // c_price = price;
            // c_quantuty = quantity;

            // var quantity = document.getElementById("quantity").value;

            if (quantity === "0") {
                alert("Quantity must be greater than 0");
                document.getElementById("quantity").value = "1";
            }else  if (quantity === "") {
                alert("Quantity must be greater than 0");
                document.getElementById("quantity").value = "1";
            }

            else {
                var price = initial_price * quantity;
                document.getElementById("price-value").innerText = price + "¥";
                c_price = price;
                c_quantity = quantity;
            }
        }

        function addtoCart() {
            c_days = document.getElementById("days").value;
            c_daily_dose = document.getElementById("daily_dose").value;
            c_piese_per_dose = document.getElementById("piese_per_dose").value;
            c_notes = document.getElementById("addNote").value;
            let instructionRadio1 = document.getElementById("defaultRadio1");
            let instructionRadio2 = document.getElementById("defaultRadio2");
            let instructionRadio3 = document.getElementById("defaultRadio3");

            if (instructionRadio1.checked) {
                c_instruction = 0;
            } else if (instructionRadio2.checked) {
                c_instruction = 1;
            } else if (instructionRadio3.checked) {
                c_instruction = 2;
            }

            if (c_menu === "") {

                return;
            }

            let newItem = {
                id: c_id,
                name: c_title,
                types: c_types,
                image: c_image,
                quantity: parseInt(c_quantuty),
                days: parseInt(c_days),
                daily_dose: parseInt(c_daily_dose),
                piese_per_dose: parseInt(c_piese_per_dose),
                instruction: parseInt(c_instruction),
                menu: c_menu,
                notes: c_notes,
                price: c_price
            };

            items.push(newItem);

            c_id = 1;
            c_title = "";
            c_types = "";
            c_image = "";
            c_price = 1;
            c_days = 1;
            c_quantuty = 1;

            c_daily_dose = 1;
            c_piese_per_dose = 1;
            c_instruction = 0;

            c_menu = "";
            var edit_selectTimes = document.getElementById("selectTimes");
            edit_selectTimes.options[0].selected = true;

            c_notes = "";

            document.getElementById("quantity").value = c_quantuty;
            document.getElementById("days").value = c_days;
            console.log(items);
            showCart();

            var modal = document.getElementById("addModal");
            var bootstrapModal = bootstrap.Modal.getInstance(modal);
            bootstrapModal.hide();
        }





        function showCart() {

            subtotal = 0.0;

            var tableBody = document.querySelector("#cart-table tbody");

            tableBody.innerHTML = ""; // clear existing rows


            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                var row = document.createElement("tr");

                var nameCell = document.createElement("td");
                nameCell.textContent = item.name;
                nameCell.style.whiteSpace = "nowrap";
                row.appendChild(nameCell);

                var typesCell = document.createElement("td");
                typesCell.textContent = item.types;
                typesCell.style.whiteSpace = "nowrap";
                row.appendChild(typesCell);

                var quantityCell = document.createElement("td");
                quantityCell.textContent = item.quantity;
                row.appendChild(quantityCell);

                var daysCell = document.createElement("td");
                daysCell.textContent = item.days;
                row.appendChild(daysCell);

                var dailyDoseCell = document.createElement("td");
                dailyDoseCell.textContent = item.daily_dose;
                row.appendChild(dailyDoseCell);

                var piesePerDoseCell = document.createElement("td");
                piesePerDoseCell.textContent = item.piese_per_dose;
                row.appendChild(piesePerDoseCell);

                // var instructionCell = document.createElement("td");
                // instructionCell.textContent = item.instruction;
                // row.appendChild(instructionCell);

                var instructionCell = document.createElement("td");

                if (item.instruction === 0) {
                    instructionCell.classList.add('after');
                    instructionCell.textContent = "After";
                } else if (item.instruction === 1) {
                    instructionCell.classList.add('before');
                    instructionCell.textContent = "Before";
                } else if (item.instruction === 2) {
                    instructionCell.classList.add('any');
                    instructionCell.textContent = "Any";
                }

                row.appendChild(instructionCell);

                var menuCell = document.createElement("td");
                menuCell.textContent = item.menu;
                menuCell.style.whiteSpace = "nowrap";
                row.appendChild(menuCell);

                var notesCell = document.createElement("td");
                var notesText = item.notes;
                var notesText = item.notes;
                var truncatedText = "";
                if (notesText) {
                    truncatedText = notesText.length > 6 ? notesText.slice(0, 6) + '...' : notesText;
                }
                notesCell.textContent = truncatedText;
                // notesCell.textContent = item.notes;
                notesCell.style.whiteSpace = "nowrap";
                row.appendChild(notesCell);

                var priceCell = document.createElement("td");
                priceCell.textContent = item.price + "¥";
                row.appendChild(priceCell);

                var actionCell = document.createElement("td");
                actionCell.style.display = "flex";
                actionCell.style.alignItems = "center";

                var editLink = document.createElement("a");
                editLink.href = "#";
                editLink.className = "btn btn-primary";
                editLink.style.display = "flex";
                editLink.style.alignItems = "center";
                editLink.style.justifyContent = "center";
                editLink.style.padding = "0 0px 2px 5px";
                editLink.style.width = "30px";
                editLink.style.height = "30px";
                editLink.style.marginRight = "10px";
                var editIcon = document.createElement("i");
                editIcon.className = "fa fa-edit";
                editIcon.style.fontSize = "16px";
                editLink.appendChild(editIcon);
                editLink.addEventListener("click", createEditHandler(i));
                actionCell.appendChild(editLink);

                var deleteLink = document.createElement("a");
                deleteLink.href = "#";
                deleteLink.className = "btn btn-danger";
                deleteLink.className = "btn btn-danger";
                deleteLink.style.display = "flex";
                deleteLink.style.alignItems = "center";
                deleteLink.style.justifyContent = "center";
                deleteLink.style.padding = "0 0px 0px 0px";
                deleteLink.style.width = "30px";
                deleteLink.style.height = "30px";
                var deleteIcon = document.createElement("i");
                deleteIcon.className = "fa fa-trash";
                deleteIcon.style.fontSize = "16px";
                deleteLink.appendChild(deleteIcon);
                deleteLink.addEventListener("click", deleteHandler(i));
                actionCell.appendChild(deleteLink);

                row.appendChild(actionCell);

                tableBody.appendChild(row);

                console.log("sub ", subtotal);
                console.log("sub ", item.price);

                subtotal = subtotal + item.price;
                console.log("sub late- ", subtotal);


            }

            document.getElementById("idSubtotal").innerText = subtotal + "¥";

            if (document.getElementById("verify_tik").checked) {
                insTotal = (subtotal * 30) / 100;
            } else {
                insTotal = 0.0;
            }
            tax = (subtotal * 15) / 100;
            total = subtotal + tax - insTotal;
            document.getElementById("idIns").innerText = insTotal + "¥";
            document.getElementById("idTax").innerText = tax + "¥";
            document.getElementById("idTotal").innerText = total.toFixed(1) + "¥";
        }

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                console.log("Checkbox is checked.");
                insTotal = (subtotal * 30) / 100;
            } else {
                insTotal = 0.0;
                console.log("Checkbox is unchecked.");
                insCode = "";
                document.getElementById("ins_code").value = insCode;
            }
            console.log(insTotal);
            total = subtotal + tax - insTotal;
            document.getElementById("ins_code").innerText = insCode;
            document.getElementById("idTotal").innerText = total.toFixed(1) + "¥";
            document.getElementById("idIns").innerText = insTotal + "¥";
        });

        function createEditHandler(index) {
            return function() {

                var modal = new bootstrap.Modal(document.getElementById("editModal"));
                modal.show();
                editCart(items[index]);
                console.log("Editing item at index", index);
                console.log("Item details:", items[index]);
            };
        }

        function editCart(item_s) {

            console.log(item_s.id);
            console.log(item_s.name);
            console.log(item_s.price);
            console.log(item_s.instruction);
            console.log(item_s.menu);
            console.log(item_s.notes);
            console.log("------");
            c_id = item_s.id;
            c_title = item_s.name;
            c_types = item_s.types;
            c_image = item_s.image;
            c_price = item_s.price;
            c_quantuty = item_s.quantity
            c_days = item_s.days;
            c_daily_dose = item_s.daily_dose;
            c_piese_per_dose = item_s.piese_per_dose;
            c_instruction = item_s.instruction;
            c_menu = item_s.menu
            c_notes = item_s.notes
            initial_price = item_s.price / item_s.quantity;

            document.getElementById("medi_title").innerText = c_title;
            document.getElementById("edit-price-value").innerText = c_price + "¥";
            document.getElementById("edit-quantity").value = c_quantuty;
            document.getElementById("edit-days").value = c_days;
            document.getElementById("edit_daily_dose").value = c_daily_dose;
            document.getElementById("edit_piese_per_dose").value = c_piese_per_dose;
            document.getElementById("edit_addNotes").value = c_notes;

            var edit_selectTimes = document.getElementById("edit_selectTimes");
            for (var i = 0; i < edit_selectTimes.options.length; i++) {
                if (edit_selectTimes.options[i].text === c_menu) {
                    edit_selectTimes.options[i].selected = true;
                    break;
                }
            }

            const afterMealRadio = document.getElementById("edit_defaultRadio1");
            const beforeMealRadio = document.getElementById("edit_defaultRadio2");
            const anyMealRadio = document.getElementById("edit_defaultRadio3");

            console.log(c_instruction);

            if (c_instruction === "0") {
                afterMealRadio.checked = true;
            } else if (c_instruction === "1") {
                beforeMealRadio.checked = true;
            } else if (c_instruction === "2") {
                anyMealRadio.checked = true;
            }

            if (c_instruction === 0) {

                console.log("0 print");
                afterMealRadio.checked = true;
            } else if (c_instruction === 1) {
                console.log("1 print");
                beforeMealRadio.checked = true;
            } else if (c_instruction === 2) {
                console.log("2 print");
                anyMealRadio.checked = true;
            }

            // edit_daily_dose edit_piese_per_dose edit_defaultRadio1

        }


        function updateCart() {
            c_days = document.getElementById("edit-days").value;
            c_daily_dose = document.getElementById("edit_daily_dose").value;
            c_piese_per_dose = document.getElementById("edit_piese_per_dose").value;
            var edit_selectTimes = document.getElementById("edit_selectTimes");
            c_menu = edit_selectTimes.options[edit_selectTimes.value].text;

            if (c_menu === "") {

                return;
            }

            c_notes = document.getElementById("edit_addNotes").value;
            let instructionRadio1 = document.getElementById("edit_defaultRadio1");
            let instructionRadio2 = document.getElementById("edit_defaultRadio2");
            let instructionRadio3 = document.getElementById("edit_defaultRadio3");
            // c_instruction = instructionRadio1.checked ? 0 : 1;

            if (instructionRadio1.checked) {
                c_instruction = 0;
            } else if (instructionRadio2.checked) {
                c_instruction = 1;
            } else if (instructionRadio3.checked) {
                c_instruction = 2;
            }


            let newItem = {
                id: c_id,
                name: c_title,
                types: c_types,
                image: c_image,
                quantity: parseInt(c_quantuty),
                days: parseInt(c_days),
                daily_dose: parseInt(c_daily_dose),
                piese_per_dose: parseInt(c_piese_per_dose),
                instruction: parseInt(c_instruction),
                menu: c_menu,
                notes: c_notes,
                price: c_price
            };

            let index = items.findIndex(item => item.id === c_id);
            if (index !== -1) {
                items.splice(index, 1, newItem);
            }

            c_id = 1;
            c_title = "";
            c_types = "";
            c_image = "";
            c_price = 1;
            c_days = 1;
            c_quantuty = 1;

            c_daily_dose = 1;
            c_piese_per_dose = 1;
            c_instruction = 0;
            c_notes = "";

            c_menu = "";
            var edit_selectTimes = document.getElementById("edit_selectTimes");
            edit_selectTimes.options[0].selected = true;

            showCart();

            var modal = document.getElementById("editModal");
            var bootstrapModal = bootstrap.Modal.getInstance(modal);
            bootstrapModal.hide();
        }

        function editquantityChanged() {
            // var quantity = document.getElementById("edit-quantity").value;
            // var price = initial_price * quantity
            // document.getElementById("edit-price-value").innerText = price + "¥";
            // c_price = price;
            // c_quantuty = quantity;


            var quantity = document.getElementById("edit-quantity").value;

            if (quantity === "0") {
                alert("Quantity must be greater than 0");
                document.getElementById("edit-quantity").value = "1";
            }else  if (quantity === "") {
                alert("Quantity must be greater than 0");
                document.getElementById("edit-quantity").value = "1";
            }

            else {
                var price = initial_price * quantity;
                document.getElementById("edit-price-value").innerText = price + "¥";
                c_price = price;
                c_quantity = quantity;
            }


        }

        var delete_items_id = [];

        function deleteHandler(index) {
            return function() {

                try {
                    delete_items_id.push(items[index].id)
                    items.splice(index, 1);
                } catch (err) {
                    console.log("An error occurred while deleting item:", err);
                }
                showCart();
            };
        }



        function processForm() {
            const fields = [{
                    id: "hospital",
                    label: "Hospital Name"
                },
                {
                    id: "department",
                    label: "Department Name"
                },
                {
                    id: "doctor_name",
                    label: "Doctor Name"
                }
            ];

            if (document.getElementById("verify_tik").checked) {

                const insCardElement = document.getElementById("ins_code").value;
                insCode = insCardElement ? insCardElement : "";
                console.log(insCode);
            } else {
                insCode = "";
            }

            const emptyFields = fields.filter(field => !document.getElementById(field.id).value.trim());
            if (emptyFields.length > 0) {
                const emptyFieldNames = emptyFields.map(field => field.label);
                console.log(`Fields are empty: ${emptyFieldNames.join(", ")}`);
                document.getElementById("fieldsEmptyModalLabel").innerText = `${emptyFieldNames.join(", ")}`;
                var modal = new bootstrap.Modal(document.getElementById("fieldsEmptyModal"));
                modal.show();
                goForUpload = false;
            } else {

                hospital = document.getElementById("hospital").value.trim() || "";
                department = document.getElementById("department").value.trim() || "";
                doctor_name = document.getElementById("doctor_name").value.trim() || "";

                goForUpload = true;
                console.log(hospital);
                console.log(department);
                console.log(doctor_name);

            }
        }

        function confirm() {

            processForm();

            if (goForUpload == false) {
                return;
            }

            console.log(items);

            if (items.length == 0) {
                return;
            }

            let prescriptionOrderId = "{{ $PrescriptionOrderId->id }}";


            //insert in the database
            if (orderDetails.length == 0) {


                console.log({{ $PrescriptionOrderId->id }});
                console.log(subtotal);
                console.log(insTotal);
                console.log(tax);
                console.log(total);
                console.log(insCode);
                console.log(hospital);
                console.log(department);
                console.log(doctor_name);

                $.ajax({
                    url: "{{ url('admin/insert-product-cart') }}",
                    method: 'POST',
                    data: {
                        items: items,
                        id: {{ $PrescriptionOrderId->id }},
                        subtotal: subtotal,
                        insTotal: insTotal,
                        tax: tax,
                        total: total,

                        insCode: insCode,
                        hospital: hospital,
                        department: department,
                        doctor_name: doctor_name
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = "{{ url('admin/Goto-pending_prescrip') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
            //update in the database
            else {

                console.log({{ $PrescriptionOrderId->id }});
                console.log(subtotal);
                console.log(insTotal);
                console.log(tax);
                console.log(total);
                console.log(insCode);
                console.log(hospital);
                console.log(department);
                console.log(doctor_name);


                $.ajax({
                    url: "{{ url('admin/update-product-cart') }}",
                    method: 'POST',
                    data: {
                        items: items,
                        id: {{ $PrescriptionOrderId->id }},
                        subtotal: subtotal,
                        insTotal: insTotal,
                        tax: tax,
                        total: total,

                        insCode: insCode,
                        hospital: hospital,
                        department: department,
                        doctor_name: doctor_name,
                        delete_items: delete_items_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.message);
                        delete_items_id = [];
                        window.location.href = "{{ url('admin/Goto-pending_prescrip') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }



        }
    </script>

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
            width: 100%;
            height: 100%;


        }
    </style>
@endsection
