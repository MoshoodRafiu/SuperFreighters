@extends('layout.base')

@section('page_info')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item"><a href="#">New</a></li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h4>New Order</h4></div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                                </div>
                            </div>
                        @elseif(Session::has('error'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input type="hidden" name="items" id="items">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="d-flex mb-2 justify-content-between align-items-center">
                                            <div class="small">Items to be delivered</div>
                                            <div>
                                                <button type="button" onclick="addItem()" class="btn btn-sm btn-info">Add</button>
                                                <button type="button" onclick="removeItem()" class="btn btn-sm btn-danger">Del</button>
                                            </div>
                                        </div>
                                        <div id="items-list">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <label class="small">Pickup Country</label>
                                        <select
                                            type="number"
                                            name="pickUpCountry"
                                            class="form-control"
                                            required
                                        >
                                            <option value="">Select Mode</option>
                                            <option value="US">US</option>
                                            <option value="UK">UK</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="small">Pickup Address</label>
                                        <textarea
                                            type="number"
                                            name="pickUpAddress"
                                            placeholder="Pickup Address"
                                            class="form-control"
                                            required
                                        ></textarea>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="small">Pickup Date</label>
                                        <input
                                            type="date"
                                            name="pickUpDate"
                                            placeholder="Item 1"
                                            class="form-control mb-1"
                                            required
                                        >
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="small">Delivery Address</label>
                                        <textarea
                                            type="number"
                                            name="deliveryAddress"
                                            placeholder="Pickup Address"
                                            class="form-control"
                                            required
                                        ></textarea>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="small">Mode of delivery</label>
                                        <select
                                            type="number"
                                            name="modeOfDelivery"
                                            class="form-control"
                                            required
                                        >
                                            <option value="">Select Mode</option>
                                            <option value="Air">Air</option>
                                            <option value="Sea">Sea</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <hr>
                                    <button class="btn btn-success">Proceed</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const container = document.getElementById('items-list');
        const itemsField = document.getElementById('items');
        function addItem(){
            const html = `<label class="w-100 d-flex"><input type="text" name="name" placeholder="Item ${container.getElementsByTagName('label').length + 1} Description" class="form-control description-field mb-1 w-75" required><input type="number" name="name" placeholder="Item ${container.getElementsByTagName('label').length + 1} Weight in Kg" step="any" class="form-control weight-field mb-1 w-25" required></label>`;
            container.insertAdjacentHTML("beforeend", html);
            setUpEventListeners();
        }
        function removeItem(){
            if (container.getElementsByTagName('label').length > 1)
            container.removeChild(container.lastChild);
            setUpEventListeners();
        }
        function populateItems(){
            const items = [];
            for (let i = 0; i < container.getElementsByTagName('label').length; i++){
                let description = container.getElementsByTagName('label')[i].childNodes[0].value;
                let weight = container.getElementsByTagName('label')[i].childNodes[1].value;
                items.push({description, weight});
            }
            itemsField.value = JSON.stringify(items);
        }
        function setUpEventListeners(){
            const descField = document.querySelectorAll('.description-field');
            const weightField = document.querySelectorAll('.weight-field');
            descField.forEach(e => {
                e.addEventListener('input', () => {
                    populateItems();
                });
            })
            weightField.forEach(e => {
                e.addEventListener('input', () => {
                    populateItems();
                });
            })
        }
        addItem();
        populateItems();
        setUpEventListeners()
    </script>
@endsection
