<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Finace\Banks;
use App\Models\Images\Image;
use App\Models\Menu\Menu;
use App\Models\Options\Option;
use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use App\Models\Policy\Policy;
use App\Models\Post\Pages;
use App\Models\Post\Post;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use SEO;
use SEOMeta;
use OpenGraph;
use Cart;


class IndexController extends Controller
{
    public $config_info;

    public function __construct()
    {
        $site_info = Option::where('type', 'general')->first();
        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $this->config_info = $site_info;

            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');

            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = Menu::where('id_group', 1)->orderBy('position')->get();
            $policy = Policy::where('status', 1)->get();
            $product_view = Product::where('status', 1)->get();

            // $order = Order::where('status', 4)->get();
            // $qty = [];
            // foreach ($order as $item) {
            //     foreach ($item->OrderDetail as $value) {

            //     }
            // }

            view()->share(compact('site_info', 'menuHeader', 'policy', 'product_view'));
        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function getHome()
    {
        $this->createSeo();
        $contentHome = Pages::where('type', 'home')->first();
        $content = json_decode(@$contentHome->content);
        $slider = Image::where('type', 'slider')->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $product_hot = Product::where('status', 1)->where('hot', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        $new_hot = Post::where('status', 1)->where('hot', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        $category = Categories::where('type', 'product_category')->get();

        return view('frontend.pages.home', compact('content', 'slider', 'product_hot', 'new_hot', 'category'));
    }

    public function getSearch(Request $request)
    {
        $q = $request->q;
        $this->createSeo();
        $dataSeo = Pages::where('type', 'products')->first();
        SEO::setTitle('T??m ki???m t??? kh??a: '.$request->q);
        $products = Product::where(function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->q . '%');
        })->where('status', 1)->orderBy('created_at', 'DESC')->get();

        $news = Post::where(function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->q . '%');
        })->where('status', 1)->orderBy('created_at', 'DESC')->get();

        return view('frontend.pages.search', compact('dataSeo', 'products', 'news', 'q'));
    }

    public function getListAbout()
    {
        $dataSeo = Pages::where('type', 'introduce')->first();
        $this->createSeo($dataSeo);

        return view('frontend.pages.introduce', compact('dataSeo'));
    }

    //S???n ph???m
    public function getListProduct()
    {
        $dataSeo = Pages::where('type', 'products')->first();
        $this->createSeo($dataSeo);

        $category = Categories::where('type', 'product_category')->get();

        return view('frontend.pages.archives-product', compact('dataSeo', 'category'));
    }

    public function getSingleProduct($slug)
    {
        $dataSeo = Pages::where('type', 'products')->first();
        $data = Product::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);

        $list_category = $data->category->pluck('id')->toArray();
        $category = Categories::where('id', $list_category)->first();
        $list_post_related = ProductCategory::whereIn('id_category', $list_category)->get()->pluck('id_product')->toArray();
        $product_related = Product::where('id', '!=', $data->id)->where('status', 1)
            ->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->take(4)->get();

        return view('frontend.pages.single-product', compact('dataSeo', 'data', 'category', 'product_related'));
    }

    public function getListProductCategory($slug) {
        $dataSeo = Pages::where('type', 'products')->first();
        $category = Categories::where('slug', $slug)->where('type', 'product_category')->first();
        $this->createSeoPost($category);

        $list_id_children = get_list_ids($category);
        $list_id_children[] = $category->id;
        $list_id_product = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
        $data = Product::where('status', 1)->whereIn('id', $list_id_product)->orderBy('created_at', 'DESC')->paginate(16);

        return view('frontend.pages.category-product', compact('dataSeo', 'category', 'data'));

    }

    public function getDetailProduct(Request $request) {
        $data = Product::where('id', $request->id)->where('status', 1)->first();

        return view('frontend.components.product-single', compact('data'));
    }

    // Tin t???c
    public function getListNews()
    {
        $dataSeo = Pages::where('type', 'news')->first();
        $this->createSeo($dataSeo);
        $data = Post::where('status', 1)->where('type', 'blog')->orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.archives-news', compact('dataSeo', 'data'));
    }

    public function getSingleNews($slug)
    {
        $dataSeo = Pages::where('type', 'news')->first();
        $data = Post::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);

        $news_related = Post::where('id', '!=', $data->id)->where('status', 1)->where('type', 'blog')->orderBy('created_at', 'DESC')->take(3)->get();

        return view('frontend.pages.single-news', compact('dataSeo', 'data', 'news_related'));
    }

    public function getListPostCategory($slug) {
        $dataSeo = Pages::where('type', 'news')->first();
        $category = Categories::where('slug', $slug)->where('type', 'post_category')->first();
        $this->createSeoPost($category);

        $list_id_children = get_list_ids($category);
        $list_id_children[] = $category->id;
        $list_id_post = PostCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_post')->toArray();
        $data = Post::where('status', 1)->whereIn('id', $list_id_post)->orderBy('created_at', 'DESC')->paginate(16);

        // return view('frontend.pages.category-product', compact('dataSeo', 'category', 'data'));
    }

    public function getContact()
    {
        $dataSeo = Pages::where('type', 'contact')->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.contact', compact('dataSeo'));
    }

    public function postContact(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = 'B???n ch??a nh???p h??? t??n';
        }

        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = 'B???n ch??a nh???p email';
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = 'Email ph???i l?? m???t ?????a ch??? email h???p l???';
            }
        }

        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = 'B???n ch??a nh???p s??? ??i???n tho???i';
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = 'Vui l??ng nh???p ????ng ?????nh d???ng s??? ??i???n tho???i. V?? d???: 0989888456';
            }
        }

        if (strlen($request->content) > 500) {
            $result['message_content'] = 'N???i dung kh??ng l???n h??n 500 k?? t???';
        }
        if($result != []){
            return json_encode($result);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $customer = Customer::create($data);
        $contact = new Contact;
        $contact->title = 'Li??n h??? t??? kh??ch h??ng';
        $contact->customer_id = $customer->id;
        $contact->content = $request->content;
        $contact->status = 0;
        $contact->save();

        $content_email = [
            'title' => 'Li??n h??? t??? kh??ch h??ng',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
            'url' => route('contact.edit', $contact->id),
        ];

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-teamplate', $content_email , function ($msg) use ($email_admin) {

            $msg->from('vunamc1601@gmail.com', 'Website - CELBEST Vi???t Nam');

            $msg->to($email_admin)->subject('Li??n h??? t??? kh??ch h??ng');

        });

        $result['success'] = 'G???i th??ng tin th??nh c??ng, ch??ng t??i s??? li??n l???c v???i b???n trong th???i gian s???m nh???t. Xin c???m ??n !';

        return json_encode($result);
    }

    public function getSinglePolicy($slug) {
        $data = Policy::where('slug', $slug)->first();
        $this->createSeoPost($data);

        return view('frontend.pages.policy', compact('data'));
    }

    // ?????t h??ng

    public function postAddCart(Request $request)
    {
        $idProduct   = $request->id_product;
        $dataProduct = Product::findOrFail($idProduct);
        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'qty'     => $request->qty,
            'price'   => ($dataProduct->is_sale == 1) ? (!empty($dataProduct->sale_price) ? $dataProduct->sale_price : 0) : (!empty($dataProduct->price) ? $dataProduct->price : 0),
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
            ],
        ];

        Cart::add($dataCart);

        return back()->with([
            'level' => 'success',
            'message' => 'Th??m v??o gi??? h??ng th??nh c??ng.'
        ]);
    }

    public function getAddCart(Request $request)
    {
        $id_product = $request->id_product;

        $dataProduct = Product::where('id', $id_product)->where('status',1)->first();

        if ($dataProduct) {
            $dataCart    = [
                'id'      => $dataProduct->id,
                'name'    => $dataProduct->name,
                'qty'     => $request->qty,
                'price'   => $request->price,

                'weight'  => 0,
                'options' => [
                    'image'       => $dataProduct->image,
                    'slug'        => $dataProduct->slug,
                ],
            ];

            Cart::add($dataCart);

            return response()->json([
                'status' =>1,
                'url' => route('home.cart')
            ]);
        } else{
            return response()->json([
                'status' => 0,
                'message' => 'S???n ph???m t???m th???i ??ang h???t h??ng, b???n vui l??ng ch???n s???n ph???m kh??c ho???c li??n h??? Hotline ????? ???????c t?? v???n. Xin c???m ??n ! ',
            ]);
        }

    }
    public function getCart()
    {
        $dataSeo = Pages::where('type', 'cart')->first();
        $this->createSeo($dataSeo);
        $product = Product::where('status', 1)->get();
        return view('frontend.pages.cart', compact('dataSeo', 'product'));
    }

    public function getRemoveCart($row)
    {
        Cart::remove($row);
        return redirect()->back()->with([
            'level' => 'success',
            'message' => 'X??a th??nh c??ng s???n ph???m ra kh???i gi??? h??ng',
        ]);
    }

    public function getUpdateCart(Request $request)
    {
        $cart_update = Cart::update($request->id, $request->qty);

        return response()->json(
            [
                'total_item' => number_format($cart_update->subtotal,0,'.','.'). ' ??',
                'total' => number_format(Cart::total(),0,'.','.'). ' ??',
                'count' => Cart::count() . ' s???n ph???m',
                'url' => route('home.cart'),
            ]
        );
    }

    public function getCheckout()
    {
        $dataSeo = Pages::where('type', 'pay')->first();
        $this->createSeo($dataSeo);
        $product = Product::where('status', 1)->get();
        $banks = Banks::where('status', 1)->get();
        return view('frontend.pages.check-out', compact('dataSeo', 'product', 'banks'));
    }

    public function postCheckOut(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = 'B???n ch??a nh???p h??? v?? t??n';
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = 'B???n ch??a nh???p email';
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = 'Email ph???i l?? m???t ?????a ch??? email h???p l???';
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = 'B???n ch??a nh???p s??? ??i???n tho???i';
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = 'Vui l??ng nh???p ????ng ?????nh d???ng s??? ??i???n tho???i. V?? d???: 0989888456';
            }
        }
        if ($request->address == '' || $request->address == null) {
            $result['message_address'] = 'B???n ch??a nh???p ?????a ch???';
        }
        if (strlen($request->note) > 500) {
            $result['message_note'] = 'N???i dung ghi chus kh??ng l???n h??n 500 k?? t???';
        }
        if($result != []){
            return json_encode($result);
        }


        if (Cart::count()) {
            $customer              = new Customer;
            $customer->name        = $request->name;
            $customer->email       = $request->email;
            $customer->phone       = $request->phone;
            $customer->address     = $request->address;
            $customer->save();

            $order                  = new Order;
            $order->id_customer     = $customer->id;
            $order->total_price     = Cart::total();

            $order->type            = $request->type_pay;
            $order->status          = 1;
            $order->note            = $request->note;

            $order->save();

            foreach (Cart::content() as $item) {
                $orderDetail                   = new OrderDetail;
                $orderDetail->id_order         = $order->id;
                $orderDetail->id_product       = $item->id;
                $orderDetail->qty              = $item->qty;
                $orderDetail->price            = $item->price;
                $orderDetail->total            = $item->price * $item->qty;
                $orderDetail->save();
            }

            $dataMail = [
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'address'     => $request->address,
                'note'        => $request->note,
                'cart'        => Cart::content(),
                'total'       => Cart::total(),
                'url'         => route('order.edit', $order->id),
            ];

            $email_admin = getOptions('general', 'email_admin');

            Mail::send('frontend.mail.mail-order', $dataMail, function ($msg) use($email_admin) {
                $msg->from('vunamc1601@gmail.com', 'Website - CELBEST VIETNAM');
                $msg->to(@$email_admin, 'Website - CELBEST VIETNAM')->subject('Th??ng b??o ????n h??ng m???i');
            });

            Cart::destroy();

            $result['success'] = '????n h??ng c???a b???n ???? ???????c ?????t th??nh c??ng. Ch??ng t??i s??? li??n h??? l???i v???i b???n trong th???i gian s???m nh???t.';

            return json_encode($result);

        } else {

            $result['error'] = 'Ch??a c?? s???n ph???m trong gi??? h??ng.';

            return json_encode($result);
        }

    }
    // End ?????t h??ng
}
