<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart()
{
    // session()->put('cart',[]);
    $cart = session()->get('cart', []);
    // dd($cart);
    $total = 0;
    $subTotal =0;
   foreach($cart as $item){
    $subTotal += $item['gia'] * $item['so_luong'];
   }
   $shipping = 30000;
   $total = $subTotal +$shipping;
    return view('clients.giohang', compact('cart','subTotal','shipping','total'));
}

public function addCart(Request $request)
{
    $productID = $request->input('product_id');
    $quantity = $request->input('quantity');
    $sanPham = SanPham::query()->findOrFail($productID);
    // khởi tạo mảng chứa tt giỏ trên session
    $cart = session()->get('cart', []);
    
    if (isset($cart[$productID])) {
        // sản phẩm đã có trong giỏ hàng 
        $cart[$productID]['so_luong'] += $quantity;
    } else {
        // sản phẩm chưa có trong giỏ hàng
        $cart[$productID] = [
            'ten_san_pham' => $sanPham->ten_san_pham,
            'so_luong' => $quantity,
            'gia' => isset($sanPham->gia_khuyen_mai) ? $sanPham->gia_khuyen_mai : $sanPham->gia_san_phams,
            'hinh_anh' => $sanPham->hinh_anh,
        ];
    }

    session()->put('cart', $cart); 
    return redirect()->back();
}

    public function updateCart(Request $request)
    {
        $cartNew = $request->input('cart',[]);
        session()->put('cart', $cartNew); 
    return redirect()->back();

    }
}
