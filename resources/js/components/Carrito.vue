<template>

      <div class="col-lg-3 col-md-3 col-12 carrito-container">
        <div id="carrito">
            <div class="my-cart">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart"></i>Carrito</a>
                        <span class="cantidad-carrito">0</span>
                        <div class="mini-cart-sub">
                            <div class="cart-product">
                                <!--<div class="single-cart">
                                    <div class="cart-img">
                                        <a href="#"><img src="/img/product/1.jpg" alt="book" /></a>
                                    </div>
                                    <div class="cart-info">
                                        <h5><a href="#">Joust Duffle Bag</a></h5>
                                        <p>1 x £60.00</p>
                                    </div>
                                    <div class="cart-icon">
                                        <a href="#"><i class="fa fa-remove"></i></a>
                                    </div>
                                </div>
                                <div class="single-cart">
                                    <div class="cart-img">
                                        <a href="#"><img src="/res_es/img/product/3.jpg" alt="book" /></a>
                                    </div>
                                    <div class="cart-info">
                                        <h5><a href="#">Chaz Kangeroo Hoodie</a></h5>
                                        <p>1 x £52.00</p>
                                    </div>
                                    <div class="cart-icon">
                                        <a href="#"><i class="fa fa-remove"></i></a>
                                    </div>
                                </div>-->
                            </div>
                            <div class="cart-totals">
                                <h5>Total <span class="precioTotal">Carrito vacío</span></h5>
                            </div>

                            <div class="cart-bottom" v-if="logged == 'true'">
                                <a class="view-cart" :href="'/es/mi-carrito/' + this.session"> Ver en detalle</a>
                                <a class="view-cart" href="/es/checkout">Comprar</a>
                                <a style="cursor: pointer;" class="view-cart vaciar-carrito">Vaciar</a>
                            </div>
                            <div class="cart-bottom" v-else>
                                <a class="view-cart" href='/es/iniciar-sesion/'> Ver en detalle</a>
                                <a class="view-cart" href='/es/iniciar-sesion/'>Comprar</a>
                                <a style="cursor: pointer;" class="view-cart vaciar-carrito">Vaciar</a>
                            </div>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
      </div>

</template>

<script>
export default {
    // Comprobar si esta logueado y modificar url comprar
    props: [
        'session',
        'logged'
    ],
    mounted() {
    }
}
</script>

<style scoped>
.carrito-container {
    display: flex;
    align-items: center;
}
</style>
