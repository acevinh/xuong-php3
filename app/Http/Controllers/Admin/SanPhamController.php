<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Thông Tin Sản phẩm";
        $listSanPham = SanPham::orderByDesc('is_type')->get();
        return view('admins.sanphams.index', compact('title', 'listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm Sản phẩm";
        $listDanhMuc = DanhMuc::query()->get();

        // $listSanPham = SanPham::orderByDesc('is_type')->get();
        return view('admins.sanphams.create', compact('title', 'listDanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            // chuyển đổi gtri checkbox thành boolean 
            // $param['is_type'];
            $param['is_new'] = $request->has('is_new') ? 1 : 0;
            $param['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $param['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $param['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
            // sử lý ảnh đại diện 
            if ($request->hasFile('hinh_anh')) {
                $param['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $param['hinh_anh'] = null;
            }
            // thêm sản phẩm
            $sanPham = SanPham::create($param);
            // lấy id sản phẩm vừa thêm để thêm đc album 
            $sanPhamID = $sanPham->id;
            // sử lý thêm album 
            if ($request->hasFile('list_hinh_anh')) {
                foreach ($request->file('list_hinh_anh') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPhamID, 'public');
                        $sanPham->hinhAnhSanPham()->create(
                            [
                                'san_pham_id' => $sanPhamID,
                                'hinh_anh' => $path,
                            ]

                        );
                    }
                }
            }
            return redirect()->route('admins.sanphams.index')->with('success', 'Thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Cập nhật thông tin Sản phẩm";
        $listDanhMuc = DanhMuc::query()->get();
        $sanPham = SanPham::query()->findOrFail($id);

        // $listSanPham = SanPham::orderByDesc('is_type')->get();
        return view('admins.sanphams.edit', compact('title', 'listDanhMuc', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            // chuyển đổi gtri checkbox thành boolean 
            // $param['is_type'];
            $param['is_new'] = $request->has('is_new') ? 1 : 0;
            $param['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $param['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $param['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            $sanPham = SanPham::query()->findOrFail($id);

            // sử lý ảnh đại diện 
            if ($request->hasFile('hinh_anh')) {
                if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }
                $param['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $param['hinh_anh'] = $sanPham->hinh_anh;
            }
            // xứ lý album
            // if ($request->hasFile('list_hinh_anh')) {
                $currentImage = $sanPham->hinhAnhSanPham->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImage, $currentImage);

                // trường xóa ảnh
                foreach ($arrayCombine as $key => $value) {
                    // tìm kiếm id trong mảng hình ảnh mới đấy lên 
                    // nếu id kh tồn tại có nghĩa ng dùng đã xóa hình ảnh đó 
                    if (!array_key_exists($key, $request->list_hinh_anh)) {
                        $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                        // xóa hình ảnh đó 
                        if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                            $hinhAnhSanPham->delete();
                        }
                    }
                }
                // trường hợp thêm hoặc sửa
                foreach ($request->list_hinh_anh as $key => $image) {
                    if (!array_key_exists($key, $arrayCombine)) {
                        if ($request->hasFile("list_hinh_anh.$key")) {
                            $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                            $sanPham->hinhAnhSanPham()->create([
                                'san_pham_id' => $id,
                                'hinh_anh' => $path,
                            ]);
                        }
                    } elseif (is_file($image) && $request->hasFile('list_hinh_anh.$key')) {
                        // trường hợp thay đổi hình ảnh 
                        $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                        if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        }
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $hinhAnhSanPham->update([
                            'hinh_anh' => $path,
                        ]);
                    }
                }
            // }
            $sanPham->update($param);
            return redirect()->route('admins.sanphams.index')->with('success', 'Cập nhật sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd(12345);
        $sanPham = SanPham::query()->findOrFail($id);
        // xóa hình ảnh đại diện
        if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
            Storage::disk('public')->delete($sanPham->hinh_anh);
        }
        // xóa albuum
        $sanPham->hinhAnhSanPham()->delete();
        // xóa toàn bộ hình ảnh trong thư mục
        $path = 'uploads/hinhanhsanpham/id_' . $id;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }
        // xóa sản phẩm
        $sanPham->delete();
        return redirect()->route('admins.sanphams.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
