@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('css')

@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> {{$title}}</h5>
                    </div><!-- end card header -->
    
                    <div class="card-body">
                        <form action="{{route('admins.danhmucs.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <div class="mb-3">
                                    <label for="hinh_anh" class="form-label">Tên danh mục</label>
                                    <input type="text" id="ten_danh_muc" name="ten_danh_muc" class="form-control @error('ten_danh_muc') is-invalid @enderror" value="{{old('ten_danh_muc')}}" placeholder="Tên danh mục">
                                    @error('ten_danh_muc')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                    
                        </div>

                        <div class="col-lg-6">
                            
                                <div class="mb-3">
                                    <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                    <input type="file" id="hinh_anh" name="hinh_anh" class="form-control  
                                    @error('hinh_anh') is-invaild @enderror" value="{{old('hinh_anh')}}" 
                                    onchange="showImage(event)"
                                    >
                                    <img id="img_danhmuc" src="" alt="ảnh sản phẩm" srcset="" style="display: none;width:150px;">
                                    {{-- <select class="form-select" id="example-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select> --}}

                                </div>
                                
                                <div class="mb-3">
                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                    <div class="col-sm-10 d-flex gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trang_thai" id="gridRadios1" value="1" checked="">
                                            <label class="form-check-label text-success" for="gridRadios1">
                                                Hiển thị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trang_thai" id="gridRadios2" value="0">
                                            <label class="form-check-label text-danger" for="gridRadios2">
                                                Ẩn
                                            </label>
                                        </div>
                                       
                                  </div>

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
<script>
    function showImage(event){
        const img_danhmuc = document.getElementById('img_danhmuc');
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload= function (){
            img_danhmuc.src= reader.result;
            img_danhmuc.style.display= 'block';

        }
        if(file){
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection