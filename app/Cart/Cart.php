<?php

namespace App\Cart;

use App\Exceptions\CartAlreadyStoredException;
use App\Exceptions\invalidGoodIdToCartException;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class Cart{
    private $session;
    private $events;
    private $instance = 'cart';

    private $decimals = 2;
    private $decimalPoint = '.';
    private $thousandSeperator = ' ';
    private $tableName = 'shoppingcart';


    function __construct(SessionManager $session, Dispatcher $events){
        $this->session = $session;
        $this->events = $events;
    }

    public function content(){
        if ($this->session->has($this->instance)) {
            return $this->session->get($this->instance);
        }

        return new Collection();
    }

    public function add($id, $qty, $price, $options = []){

        if (empty($id) || !is_numeric($id)) {
            throw new \InvalidArgumentException('Please supply a valid id.');
        }

        if (strlen($qty) < 0 || !is_numeric($qty)) {
            throw new \InvalidArgumentException('Please supply a valid qty.');
        }

        if (strlen($price) < 0 || !is_numeric($price)) {
            throw new \InvalidArgumentException('Please supply a valid price.');
        }

        $item = new CartItem($id, $qty, $price, $options);

        $content = $this->content();

        if ($content->has($item->id)) {
            $item->qty += $content->get($item->id)->qty;
        }

        $content->put($item->id, $item);
        $this->events->dispatch('cart.adding', $item);
        $this->session->put($this->instance, $content);
        $this->events->dispatch('cart.added', $item);

        return $item;
    }

    public function update($id, $qty)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new \InvalidArgumentException('Please supply a valid id.');
        }
        if (strlen($qty) < 0 || !is_numeric($qty)) {
            throw new \InvalidArgumentException('Please supply a valid $qty.');
        }

        $cartItem = $this->get($id);
        $cartItem->qty = $qty;
        $content = $this->content();

        if ($id !== $cartItem->id) {
            $itemOldIndex = $content->keys()->search($id);

            $content->pull($id);

            if ($content->has($cartItem->id)) {
                $existingCartItem = $this->get($cartItem->id);
                $cartItem->setQuantity($existingCartItem->qty + $cartItem->qty);
            }
        }

        if ($cartItem->qty <= 0) {
            $this->remove($cartItem->id);

            return;
        } else {
            if (isset($itemOldIndex)) {
                $content = $content->slice(0, $itemOldIndex)
                    ->merge([$cartItem->id => $cartItem])
                    ->merge($content->slice($itemOldIndex));
            } else {
                $content->put($cartItem->id, $cartItem);
            }
        }

        $this->events->dispatch('cart.updating', $cartItem);
        $this->session->put($this->instance, $content);
        $this->events->dispatch('cart.updated', $cartItem);

        return $cartItem;
    }

    public function remove($id){

        if (empty($id) || !is_numeric($id)) {
            throw new \InvalidArgumentException('Please supply a valid id.');
        }

        $cartItem = $this->get($id);
        $content = $this->content();
        $content->pull($cartItem->id);
        $this->events->dispatch('cart.removing', $cartItem);
        $this->session->put($this->instance, $content);
        $this->events->dispatch('cart.removed', $cartItem);
    }

    public function get($id){

        if (empty($id) || !is_numeric($id)) {
            throw new \InvalidArgumentException('Please supply a valid id.');
        }

        $content = $this->content();

        if (!$content->has($id)) {
//            throw new invalidGoodIdToCartException("The cart does not contain Good id {$id}.");
            return false;
        }

        return $content->get($id);
    }

    public function countItem($id){

        if (empty($id) || !is_numeric($id)) {
            throw new \InvalidArgumentException('Please supply a valid id.');
        }

        $item = $this->get($id);

        if ($item){
            return $item->qty;
        }

        return 0;
    }

    public function destroy(){
        $this->session->remove($this->instance);
    }


    public function count(){
        return $this->content()->sum('qty');
    }

    public function countItems(){
        return $this->content()->count();
    }

    public function totalFloat(){
        $total = $this->content()->reduce(function ($total, CartItem $cartItem) {
            return ($total + $cartItem->total());
        }, 0);

        //return round((float)$total, $this->decimals);
        return $total;

    }

    public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null){
        return $this->numberFormat($this->totalFloat(), $decimals, $decimalPoint, $thousandSeperator);
    }

    private function numberFormat($value, $decimals, $decimalPoint, $thousandSeperator){
        if (is_null($decimals)) {
            $decimals = $this->decimals;
        }

        if (is_null($decimalPoint)) {
            $decimalPoint = $this->decimalPoint;
        }

        if (is_null($thousandSeperator)) {
//            $thousandSeperator = config('cart.format.thousand_separator', ',');
            $thousandSeperator = $this->thousandSeperator;
        }

        return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
    }


    public function store($identifier){
        $content = $this->content();
        $instance = $this->instance;

        if ($this->storedCartInstanceWithIdentifierExists($this->instance, $identifier)) {
            throw new CartAlreadyStoredException("A cart with identifier {$identifier} was already stored.");
        }

        $serializedContent = serialize($content);

        \DB::table($this->tableName)->insert([
            'identifier' => $identifier,
            'instance'   => $instance,
            'content'    => $serializedContent,
           // 'created_at' => $this->createdAt ?: Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->events->dispatch('cart.stored');
    }

    public function restore($identifier){
        $currentInstance = $this->instance;

        if (!$this->storedCartInstanceWithIdentifierExists($this->instance, $identifier)) {
            return;
        }

        $stored = \DB::table($this->tableName)
            ->where(['identifier'=> $identifier, 'instance' => $currentInstance])->first();

        $storedContent = unserialize(data_get($stored, 'content'));

        $content = $this->content();

        foreach ($storedContent as $cartItem) {
            $content->put($cartItem->id, $cartItem);
        }

        $this->events->dispatch('cart.restored');
        $this->session->put($this->instance, $content);

        \DB::table($this->tableName)->where(['identifier' => $identifier, 'instance' => $currentInstance])->delete();
    }

    public function merge($identifier){
        if (!$this->storedCartInstanceWithIdentifierExists($this->instance, $identifier)) {
            return false;
        }

        $stored = \DB::table($this->tableName)
            ->where(['identifier'=> $identifier, 'instance'=> $this->instance])->first();

        $storedContent = unserialize($stored->content);
        foreach ($storedContent as $cartItem) {
           // dd($cartItem);
            $this->add($cartItem->id, $cartItem->qty, $cartItem->price, $cartItem->options);
        }

        $this->events->dispatch('cart.merged');

        return true;
    }

    public function erase($identifier){
        $instance = $this->instance;

        if (!$this->storedCartInstanceWithIdentifierExists($instance, $identifier)) {
            return;
        }

        \DB::table($this->tableName)->where(['identifier' => $identifier, 'instance' => $instance])->delete();

        $this->events->dispatch('cart.erased');
    }

    private function storedCartInstanceWithIdentifierExists($instance, $identifier){
        return \DB::table($this->tableName)->where(['identifier' => $identifier, 'instance'=> $instance])->exists();
    }

}
