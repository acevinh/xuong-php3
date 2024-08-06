@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- Quill css -->
    <link href="{{ asset('assets/admin/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý thông tin sản phẩm</h4>

                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"> {{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.sanphams.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="row">
                                    <div class="col-lg-4">

                                        {{-- <div class="mb-3">
                                            <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                                            <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                                                class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                value="{{ old('ten_danh_muc') }}" placeholder="Tên danh mục">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                            <input type="text" id="ma_san_pham" name="ma_san_pham"
                                                class="form-control @error('ma_san_pham') is-invalid @enderror"
                                                value="{{ old('ma_san_pham') }}" placeholder="Mã sản phẩm">
                                            @error('ma_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                            <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                class="form-control @error('ten_san_pham') is-invalid @enderror"
                                                value="{{ old('ten_san_pham') }}" placeholder="Tên sản phẩm">
                                            @error('ten_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="gia_san_pham" name="gia_san_pham"
                                                class="form-control @error('gia_san_pham') is-invalid @enderror"
                                                value="{{ old('gia_san_pham') }}" placeholder="Giá sản phẩm">
                                            @error('gia_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                            <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                                class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                                value="{{ old('gia_khuyen_mai') }}" placeholder="Giá khuyến mãi">
                                            @error('gia_khuyen_mai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="danh_muc_id" class="form-label">Danh mục</label>
                                            <select name="danh_muc_id" id=""
                                                class="form-select @error('danh_muc_id') is-invalid @enderror">
                                                <option value="" selected>--Chọn danh mục--</option>
                                                @foreach ($listDanhMuc as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('danh_muc_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            @error('danh_muc_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="so_luong" class="form-label">Số lượng sản phẩm</label>
                                            <input type="number" id="so_luong" name="so_luong"
                                                class="form-control @error('so_luong') is-invalid @enderror"
                                                value="{{ old('so_luong') }}" placeholder="Số lượng sản phẩm">
                                            @error('so_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                            <input type="date" id="ngay_nhap" name="ngay_nhap"
                                                class="form-control @error('ngay_nhap') is-invalid @enderror"
                                                value="{{ old('ngay_nhap') }}" placeholder="Ngày nhập">
                                            @error('ngay_nhap')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                                            <textarea class="form-control @error('mo_ta_ngan') is-invalid @enderror" name="mo_ta_ngan" id="mo_ta_ngan"
                                                cols="" rows="3" placeholder="Mô tả ngắn">{{ old('mo_ta_ngan') }}</textarea>
                                            @error('mo_ta_ngan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="is_type" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_type"
                                                        id="gridRadios1" value="1" checked="">
                                                    <label class="form-check-label text-success" for="gridRadios1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_type"
                                                        id="gridRadios2" value="0">
                                                    <label class="form-check-label text-danger" for="gridRadios2">
                                                        Ẩn
                                                    </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="is_type">Tùy chỉnh khác</label>
                                            <div class=" form-switch mb-2 ps-3 d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input bg-danger" type="checkbox"
                                                        id="is_new" name="is_new" checked="">
                                                    <label class="form-check-label" for="is_new">New</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-secondary" type="checkbox"
                                                        id="is_hot" name="is_hot" checked="">
                                                    <label class="form-check-label" for="is_hot">Hot</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-warning" type="checkbox"
                                                        id="is_hot_deal" name="is_hot_deal" checked="">
                                                    <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input bg-success" type="checkbox"
                                                        id="is_show_home" name="is_show_home" checked="">
                                                    <label class="form-check-label" for="is_show_home">Show home</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">

                                        {{-- mo ta dai  --}}

                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Mô tả chi tiết sản phẩm</label>
                                            <div id="quill-editor" style="height: 400px;" class="ql-container ql-snow">
                                                <textarea name="noi_dung" id="noi_dung_content" class="d-none"> 
                                                    <div class="ql-editor" data-gramm="false" contenteditable="true">
                                                </div>
                                                </textarea>
                                                <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input type="file" id="hinh_anh" name="hinh_anh"
                                                class="form-control  
                                    @error('hinh_anh') is-invaild @enderror"
                                                value="{{ old('hinh_anh') }}" onchange="showImage(event)">
                                            <img id="img_danhmuc" src="" alt="ảnh sản phẩm" srcset=""
                                                style="display: none;width:150px;">


                                        </div>
                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Album ảnh</label>
                                            <i id="add-row"
                                                class="mdi mdi-plus text-muted fs-18 rounded-2 border ms-3 p-1"
                                                style="cursor: pointer"></i>
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img id="preview_0"
                                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrVLGzO55RQXipmjnUPh09YUtP-BW3ZTUeAA&s"
                                                                alt="ảnh sản phẩm" srcset="" style="width:50px;"
                                                                class="me-3">
                                                            <input type="file" id="hinh_anh"
                                                                name="list_hinh_anh[id_0]"
                                                                class="form-control  
@error('hinh_anh') is-invaild @enderror"
                                                                value="{{ old('hinh_anh') }}"
                                                                onchange="previewImage(this,0)">
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                                style="cursor: pointer" ></i>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>


                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection
@section('js')
    <!-- Quill Editor Js -->
    <script src="{{ asset('assets/admin/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/quill/quill.min.js') }}"></script>
    <script>
        function showImage(event) {
            const img_danhmuc = document.getElementById('img_danhmuc');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_danhmuc.src = reader.result;
                img_danhmuc.style.display = 'block';

            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    {{-- cua phan noi dung --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",

            })

            // hiển thị nội dung cũ
            var old_content = `{!! old('noi_dung') !!}`;
            quill.root.innerHTML = old_content;
            // cập nhật lại textarea khi quill editor đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('noi_dung_content').value = html;
            })
        })
    </script>
    {{-- su ly them album --}}
    <script>
        // them hinh anh
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;
document.getElementById('add-row').addEventListener('click',function () {
    var tableBody = document.getElementById('image-table-body');
    var newRow = document.createElement('tr');
            newRow.innerHTML = ` <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrVLGzO55RQXipmjnUPh09YUtP-BW3ZTUeAA&s"
                            alt="ảnh sản phẩm" srcset="" style="width:50px;"
                            class="me-3">
                        <input type="file" id="hinh_anh"
                            name="list_hinh_anh[id_${rowCount}]"
                            class="form-control  @error('hinh_anh') is-invaild @enderror"
                            value="{{ old('hinh_anh') }}"
                            onchange="previewImage(this,${rowCount})">
                    </td>
                    <td>
                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer" onclick="removeRow(this)"></i>

                    </td>`;

                    tableBody.appendChild(newRow);
                    rowCount++;
})
        });
        // thay doi hinh anh cua item
       function previewImage(input,rowIndex){
     if(input.files && input.files[0]){
        const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(`preview_${rowIndex}`).setAttribute('src',e.target.result)

            }
           
                reader.readAsDataURL(input.files[0]);
            
     }
       }
    //    removeRow
    function removeRow(item) {
        var row = item.closest('tr');
        row.remove();
    }
    </script>
@endsection
