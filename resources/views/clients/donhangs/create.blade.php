@extends('layouts.client')

@section('css')
@endsection

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <form action="{{ route('donhangs.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                    <input type="text" name="ten_nguoi_nhan" placeholder="ENhập tên người nhận"
                                        value="{{ Auth::user()->name }}" />

                                    @error('ten_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="email_nguoi_nhan" class="required">Email người nhận</label>
                                    <input type="email" name="email_nguoi_nhan" placeholder="Email người nhận"
                                        value="{{ Auth::user()->email }}" />

                                    @error('email_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="so_dien_thoai_nguoi_nhan" class="required">Số điện thoại người nhận</label>
                                    <input type="text" name="so_dien_thoai_nguoi_nhan"
                                        placeholder="Số điện thoại người nhận" value="{{ Auth::user()->phone }}" />

                                    @error('so_dien_thoai_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ người nhận</label>
                                    <input type="text" name="dia_chi_nguoi_nhan" placeholder="Địa chỉ người nhận"
                                        value="{{ Auth::user()->address }}" />

                                    @error('dia_chi_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="ordernote">Ghi chú</label>
                                    <textarea name="ghi_chu" id="ordernote" cols="30" rows="3" placeholder="Nhập ghi chú."></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $key => $item)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('products.detail', $key) }}">
                                                            {{ $item['ten_san_pham'] }} <strong> ×
                                                                {{ $item['so_luong'] }}</strong>
                                                        </a>
                                                    </td>
                                                    <td>{{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }} đ
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>
                                                    <strong>{{ number_format($subTotal, 0, '', '.') }} đ</strong>
                                                    <input type="hidden" name="tien_hang" value="{{ $subTotal }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td>
                                                    <strong>{{ number_format($shipping, 0, '', '.') }} đ</strong>
                                                    <input type="hidden" name="tien_ship" value="{{ $shipping }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td>
                                                    <b>{{ number_format($total, 0, '', '.') }} đ</b>
                                                    <input type="hidden" name="tong_tien" value="{{ $total }}">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" value="cash"
                                                    class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Thanh toán khi giao
                                                    hàng</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Thanh toán bằng tiền mặt khi giao hàng.</p>
                                        </div>
                                    </div>
                                    <div class="summary-footer-area">
                                        <button type="submit" class="btn btn-sqr">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout main wrapper end -->
@endsection

@section('js')
@endsection
