<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Colors;
use App\Models\Saleoffs;
use App\Models\Sizes;
use App\Models\Tags;
use App\Models\OrderDetails;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $userId = Auth::id();
        $orderCount = OrderDetails::where('CustomerId', $userId)->count();
        return view('user.index', compact('orderCount'));
    }
    public function about()
    {
        $userId = Auth::id();
        $orderCount = OrderDetails::where('CustomerId', $userId)->count();
        return view('user.about',compact('orderCount'));
    }
    public function login()
    {
        return view('user.auth.login');
    }
    private function buildCategoryTree($categories, $parentId = 0, $level = 0)
    {
        $branch = [];

        foreach ($categories as $category) {
            if ($category->ParentId == $parentId) {
                $category->level = $level;
                $branch[] = $category;
                $children = $this->buildCategoryTree($categories, $category->CategoryId, $level + 1);
                $branch = array_merge($branch, $children);
            }
        }

        return $branch;
    }
    public function shop()
    {
        $data = Products::paginate(15);
        $allCategories = Categories::all();
        $categories = $this->buildCategoryTree($allCategories);
        $colors = Colors::all();
        $sizes = Sizes::all();
        $user = Session::get('user');
        $orderCount = OrderDetails::where('CustomerId', $user->CustomerId)->count();
        return view('user.shop',compact('data','colors', 'sizes', 'categories', 'orderCount'));
    }
    public function searchProduct(Request $request)
    {
        $allCategories = Categories::all();
        $categories = $this->buildCategoryTree($allCategories);
        $colors = Colors::all();
        $sizes = Sizes::all();
        $keyword = $request->input('query');
        $user = Session::get('user');
        $orderCount = OrderDetails::where('CustomerId', $user->CustomerId)->count();
         $products = Products::where('ProductName', 'like', "%$keyword%")->paginate(10);
        return view('user.shop', ['data' => $products, 'colors' => $colors, 
        'sizes' => $colors, 'categories' => $categories, 'orderCount' => $orderCount]);
    }
    public function detail($ProductId)
    {
        $user = Session::get('user');
        $product = Products::where('ProductId', $ProductId)->first();
        $categories = Categories::all();
        $colors = $product->colors()->get();
        $sizes = $product->sizes()->get();
        $saleoffs = $product->saleoffs()->get();
        $tags = $product->tags()->get();
        $orderCount = OrderDetails::where('CustomerId', $user->CustomerId)->count();
        return view('user.detail',compact('product','colors', 'sizes', 'saleoffs', 'tags', 'categories','orderCount'));
    }
    public function add_cart(Request $request, $id)
{
    $user = Session::get('user');

    if ($user) {
        $product = Products::find($id);

        // Check if product already exists in cart
        $existingItem = OrderDetails::where('CustomerId', $user->CustomerId)
            ->where('ProductId', $product->ProductId)
            ->where('SizeId', $request->size)
            ->where('ColorId', $request->color)
            ->first();
        $size = Sizes::where('SizeId', $request->size)->first();
        $color = Colors::where('ColorId', $request->color)->first();
        if ($existingItem) {
            // Product already exists in cart
            return redirect('shop')
                ->with('message_type', 'error') // Set message type for styling
                ->with('message', 'This product (size: ' . $size->SizeName . ', color: ' . $color->ColorIllustration . ') is already in your cart!');
        } else {
            // Add product to cart
            $detail = new OrderDetails;
            $detail->CustomerId = $user->CustomerId;
            $detail->ProductId = $product->ProductId;
            $detail->ProductName = $product->ProductName;
            $detail->ProductPhoto = $product->ProductPhoto;
            $detail->Quantity = $request->quantity;
            $detail->SizeId = $request->size;
            $detail->ColorId = $request->color;
            $detail->SalePrice = $product->Price;

            try {
                $detail->save();

                // Save successful - Display success message
                return redirect('shop')
                    ->with('message_type', 'success') // Set message type for styling
                    ->with('message', 'Product added to cart successfully!');
            } catch (Exception $e) {
                // Save failed - Display error message
                return redirect('shop')
                    ->with('message_type', 'error') // Set message type for styling
                    ->with('message', 'Failed to add product to cart. Please try again.');
            }
        }
    } else {
        return redirect('login');
    }
}
    public function showcart()
    {
        $user = Session::get('user');

        if ($user) {
            $orders = OrderDetails::where('CustomerId', $user->CustomerId)->get();
            $orderCount = OrderDetails::where('CustomerId', $user->CustomerId)->count();

            // Eager loading for color và size names
            if (config('app.eager_load_cart_details')) {
                $orders = $orders->load(['color:id,name', 'size:id,name']); // Eager load color và size
            } else {
                // Eager loading not configured - Perform separate queries
                foreach ($orders as $order) {
                    $order->color = Colors::find($order->ColorId);
                    $order->size = Sizes::find($order->SizeId);
                }
            }

            return view('user.showcart', compact('orders', 'orderCount'));
        } else {
            return redirect('login');
        }
    }
    public function delete_cart($id){
        $order = OrderDetails::where('OrderId', $id)->first();
        $order->delete();
        return redirect()->back();
    }

    public function signup()
    {
        return view('user.auth.signup');
    }
     public function contact()
    {
        $userId = Auth::id();
        $orderCount = OrderDetails::where('CustomerId', $userId)->count();
        return view('user.contact',compact('orderCount'));
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Customers::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->Password)) {
                Session::put('user', $user);
                $user = Session::get('user');
                $orderCount = OrderDetails::where('CustomerId', $user->CustomerId)->count();
                auth::login($user);
                return view('user.index',compact('orderCount'));
            } else {
                return redirect()->back()->with('error', 'Mật khẩu không chính xác.');
            }
        } else {
            return redirect()->back()->with('error', 'Email không tồn tại');
        }
    }
    public function signupSubmit(Request $request)
    {
        $existUser = Customers::where('Email', $request->Email)->first();

        if ($existUser) {
            return redirect()->back()->with('error', 'Email đã tồn tại !');
        }
        $customer = new Customers();
        $customer->Fullname = $request->Fullname;
        $customer->Email = $request->Email;
        $customer->Phone = $request->Phone;
        $customer->Address = $request->Address;
        $customer->Password = Hash::make($request->Password);
        $customer->save();
        return redirect()->route('login')->with('message', 'Thêm khách hàng thành công');
    }



    public function signout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->route('index');
    }
}
