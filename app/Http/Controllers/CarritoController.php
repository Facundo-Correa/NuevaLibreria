<?php

namespace App\Http\Controllers;

use App\carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use TypiCMS\Modules\Books\Facades\Books;
use TypiCMS\Modules\Books\Models\Book;
use TypiCMS\Modules\Promocions\Facades\Promocions;
use TypiCMS\Modules\Users\Models\User;

class CarritoController extends Controller
{
    //
    public function detailCart($userID){
        $user = carrito::where('session_id', $userID)->first();
        if($user){
            return view('pages::public.carrito', compact('user'));
        }
        else {
            return redirect('/es/iniciar-sesion');
        }
    }

    public function redirect() {
        return redirect('/es/iniciar-sesion');
    }


    public function getCart(Request $req) {
        /*
        $bus = null;
        // || Chequear si algun carrito coincide con el SessionID
        $bus = carrito::where('SessionID', Session::getId())->first();

        // || Si sigue siendo null, buscar algunuo que coincida con el UserId en caso de estar logueado
        if($bus == null){
            if(isset(Auth::user()->id)){
                $bus = carrito::where('UserId', Auth::user()->id)->first();

                // || Si se encontró, actualizar Session
                if($bus!=null){
                    $bus->SessionID = Session::getId();
                    $bus->save();
                }
            }
        }
        else {
            // || De lo contrario actualizar user id
            if(isset(Auth::user()->id)){
                $bus->UserId = Auth::user()->id;
            }
        }

        // || Si sigue siendo nulo, crear

        if($bus == null){
            $bus = new carrito();

            $bus->Cart = '[]';
            $bus->SessionID = Session::getId();
            if(isset(Auth::user()->id)){
                $bus->UserId = Auth::user()->id;
            }
        }

        $bus->save();*/

        $cart = carrito::where('session_id', Session::getId())->get();
        //dd($cart);
        $retorno = [];
        /*
        for($i = 0; $i<count($cart); $i++){
           // || precio, cantidad, titulo, barcode
            array_push($retorno, Array(
                'image' => '/img/covers/' . $cart[$i]->content->barcode . '.jpg',
                'title' => $cart[$i]->content->title,
                'quant' => $cart[$i]->quantity,
                'price' => $cart[$i]->price,
                'isbn' => $cart[$i]->content->isbn,
            ));

        }*/

        foreach($cart as $producto) {
            $book = Books::where('isbn', $producto->book_isbn)->first();
            array_push($retorno, Array(
                'image' => '/img/covers/' . $book->isbn1 . '.jpg',
                'title' => $book->title,
                'quant' => $producto->cantidad,
                'price' => $producto->precio,
                'isbn' => $book->isbn,
            ));
        }

        return $retorno;

    }

    public function addToCart(Request $req) {
        /*
        $cantidad = $req->cantidad;
        $bookISBN = $req->book;
        $id = $req->id;


        $cart = carrito::select('*')->where('SessionID', $id)->first();
        if($cart == null){
            // || La sesion no tiene carrito
            $car = new carrito();
            $car->SessionID = $id;
            $car->Cart = '[]';
            $car->save();

            $cart = $car;
        }

        if(Auth::user()){
            $cart->UserId = Auth::user()->id;
        }

        $book = Book::where('isbn', $bookISBN)->first();

        // || Get the books on cart
        $cartBooks = json_decode($cart->Cart);


        $price = 0;
        $indiceBook = false;

        // || Check if the book is on cart
        for($i = 0; $i<count($cartBooks); $i++) {
            $tempBook = $cartBooks[$i]->content;
            // || Str compare


            if(strcmp($tempBook->isbn, $book->isbn) == 0){

                // || If it's on cart, append to cuantity
                // || $price = $cartBooks[$i]->price;

                $cartBooks[$i]->quantity += $cantidad;
                $cartBooks[$i]->price = $this->getPrice($book->isbn, $cartBooks[$i]->quantity, $book->price);
                $indiceBook = true;
                break;
            }
        }

        if ($indiceBook == false) {
            // || Else add to cart
            $libro = array(
                'content' => $book,
                'quantity' => $cantidad,
                'price' => $this->getPrice($book->isbn, $cantidad, $book->price),
            );

            array_push($cartBooks, $libro);
        }

        $cart->Cart = $cartBooks;
        $cart->save();
        */

        // || New add To Cart

        // || BookID => ISBN

        // || if login, use user_id & synchronize with session_id
        $cantidad = $req->cantidad;
        $session_id = session()->getId();
        $price = 0;

        if(Auth::user()) {
            $user_id = Auth::user()->id;
            $productos = carrito::where('user_id', $user_id)->get();
            foreach($productos as $p) {
                $p->session_id = $session_id;
                $p->save();
            }
        }

        // || Si el producto esta asociado a la sesion, con mismo book_isbn ^ price, agregar cantidad
        if($producto = carrito::where([['session_id', $session_id], ['book_isbn', $req->book]])->first()) {
            $producto->cantidad += $cantidad;
            //$price = $this->getPrice($req->book, $producto->cantidad, Book::where('isbn', $req->book)->first()->price);

            $book = Book::where('isbn', $req->book)->first();
            $price = $book->price * $producto->cantidad;

            $producto->precio = $price;
            $producto->save();
        }
        else {
            // || Crear producto en carrito
            $producto = new carrito();
            $producto->cantidad = $cantidad;
            //$producto->precio = $this->getPrice($req->book, 1, Book::where('isbn', $req->book)->first()->price);

            $producto->precio = Book::where('isbn', $req->book)->first()->price;

            $producto->book_isbn = $req->book;
            $producto->user_id = Auth::user()?Auth::user()->id:null;
            $producto->session_id = $session_id;
            $producto->save();
        }

    }

    public function removeFromCart(Request $req) {
        /*
        $userID = $req->id;
        $isbn = $req->isbn;

        // || $user = User::where('id', $userID)->first();
        $carr = carrito::where('SessionID', $userID)->first();
        $cart = json_decode($carr->Cart);

        $carrito = array();

        for($i = 0; $i<count($cart); $i++){
            if(strcmp($cart[$i]->content->isbn, $isbn) == 0){
                continue;
            }
            else {
                array_push($carrito, $cart[$i]);
            }
        }

        $carr->Cart = $carrito;
        $carr->save();*/

        // || Use session_id
        $session_id = Session::getId();
        $isbn = $req->isbn;

        $producto = carrito::where([ ['session_id', $session_id], ['book_isbn', $isbn] ])->first();
        $producto->delete();

        return 'Element removed';
    }

    public function emptyCart(Request $req) {
        $cart = carrito::where('session_id', Session::getId())->get();
        foreach ($cart as $producto) {
            $producto->delete();
        }

    }

    public function modifyCantidad(Request $request) {
        if(isset(Auth::user()->id)){
            $item = carrito::where('user_id', Auth::user()->id)->where('book_isbn', $request->isbn)->first();

        }
        else {
            $item = carrito::where('session_id', Session::getId())->where('book_isbn', $request->isbn)->first();

        }
        if($request->cantidad <1) {
            $item->delete();
            return;
        }
        $item->cantidad = $request->cantidad;
        $item->save();
    }

/*
    function getPrice($isbn, $quantity, $originalPrice){
		$promociones = Promocions::all();
		foreach($promociones as $promo){

			$lep = explode(',', $promo->books_isbns);
			$length = count($lep);

			for($i = 0; $i<$length; $i++){
				if(strcmp($isbn, $lep[$i]) == 0){
					$descuento = (int)(explode(',', $promo->books_desc)[$i]);
					$precio = (int) ($originalPrice) * (int) ($quantity);

					//$retorno = ($precio - (($precio * $descuento)/100))*$quantity;
                    $retorno = ($precio - (($precio * $descuento)/100));
                    return $retorno;
				}
			}
		}
        return $originalPrice * $quantity;


    }
*/
}
