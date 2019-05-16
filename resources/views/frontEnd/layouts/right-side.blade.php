<div class="card">
    <div class="card-header">
        Cart info
    </div>
    <div class="card-body p-0 m-0">
        <?php
        use App\Cart_model;
        use Illuminate\Support\Facades\Session;
        $session_id = Session::get('session_id');
        if(empty($session_id)){
            echo '<p class="p-4">Cart is empty.</p>';
        }else{
            $cart_products = Cart_model::where('session_id',$session_id)->get();
            ?>

            <table class="table small p-0 m-0">
                <tbody>
                <?php $totalPrice = 0; ?>
                @foreach($cart_products as $cp)
                    <?php $totalPrice = $totalPrice + ($cp->price * $cp->quantity); ?>
                    <tr>
                        <td>{{$cp->quantity}} x</td>
                        <td>{{$cp->product_name}}</td>
                        <td>{{$cp->price}} TL</td>
                    </tr>
                @endforeach
                    <tr>
                        <td>Total:</td>
                        <td>{{$totalPrice}} TL</td>
                    </tr>
                </tbody>
            </table>

            <?php
        }
        ?>
    </div>
</div>