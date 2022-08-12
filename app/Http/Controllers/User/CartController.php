<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;
use App\Jobs\SendThanksMail;
use App\Jobs\SendOrderMail;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach($products as $product){
            //金額とカート内全ての商品の個数をかける
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart',
            compact('products','totalPrice'));
    }

    public function add(Request $request)
    {
        //ログインしているユーザーとプロダクトIDが両方満たすものを1件のアイテムを取得する
        $itemInCart = Cart::where('product_id', $request->product_id)->where('user_id',Auth::id())->first();

        //カートに商品が入っていたら
        if($itemInCart){
            //カートに入っているのが1つでもう一つカードに入れたら増える
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        }else {
            Cart::create([
                'user_id' => Auth::id(), //ログインしているユーザーID
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
        //カートに商品を入れたらindex画面に飛ばす
        return redirect()->route('user.cart.index');
    }


    public function delete($id)
    {
        Cart::where('product_id',$id)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('user.cart.index');
    }

    //決済処理
    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $lineItems = [];
        foreach($products as $product){
            $quantity = '';
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');

            if($product->pivot->quantity > $quantity){
                return redirect()->route('user.cart.index');
            } else {
                $lineItem = [
                    'price_data' => [
                        'currency' => 'jpy',
                        'unit_amount' => $product->price,
                        'product_data' => [
                            'name' => $product->name,
                            'description' => $product->information,
                        ],
                    ],
                    'quantity' => $product->pivot->quantity,
                ];
                array_push($lineItems, $lineItem);
            }
        }
        // dd($lineItems);
        foreach($products as $product){
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1
            ]);
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel'),
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout',
            compact('session', 'publicKey'));
    }

    //購入成功時の処理
    public function success()
    {
        ////
        $items = Cart::where('user_id',Auth::id())->get();
        $products = CartService::getItemsInCart($items);
        $user = User::findOrFail(Auth::id());

        SendThanksMail::dispatch($products, $user);
        foreach($products as $product)
        {
            SendOrderMail::dispatch($product, $user);
        }
        ////

        //購入が成功したらカートを空にする
        Cart::where('user_id',Auth::id())->delete();

        //成功したら商品一覧ページに戻る
        return redirect()->route('user.items.index');
    }

    //キャンセル処理
    public function cancel()
    {
        //ユーザーID取得
        $user = User::findOrFail(Auth::id());

        foreach($user->products as $product){
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['add'],
                'quantity' => $product->pivot->quantity
            ]);
        }

        return redirect()->route('user.cart.index');

    }
}