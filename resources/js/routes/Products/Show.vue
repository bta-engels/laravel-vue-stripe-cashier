<template>
    <section class="text-gray-700 body-font overflow-hidden" v-if="product">
        <div class="container px-12 py-24 mx-auto">
            <div class="lg:w-3/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/640x640">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1
                        class="text-gray-900 text-3xl title-font font-medium mb-2"
                        v-text="product.name"
                    ></h1>
                    <p
                        class="leading-relaxed"
                        v-text="product.description"
                    ></p>

                    <div class="flex mt-6 pt-4 border-t-2 border-gray-200">
                        <label>Size: </label>
                        <select class="ml-2" v-if="sizes" v-model="size" required>
                            <option value="">Grösse wählen ...</option>
                            <option
                                class="p-2 font-bold"
                                v-for="size in sizes"
                                :key="size.id">{{ size.name }}</option>
                        </select>
                    </div>
                    <div class="flex mt-6 pt-4 border-t-2 border-gray-200">
                        <span
                            class="title-font font-medium text-2xl text-gray-900"
                            v-text="formatCurrency(product.price)"
                        ></span>
                        <button
                            class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                            @click="addToCart(product, size)"
                        >Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                size: "",
            }
        },
        methods: {
            formatCurrency(amount) {
                amount = (amount / 100);
                return amount.toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });
            },
            addToCart(product, size) {
                product.size = size ?? null;
                delete(product.sizes);
                this.$store.commit('addToCart', product);
            }
        },
        computed: {
            products() {
                return this.$store.state.products;
            },
            product() {
                return  this.products.find(product => product.slug === this.$route.params.slug);
            },
            sizes() {
                if(this.product.sizes && this.product.sizes.length > 0) {
                    return this.product.sizes.map(item => item.size);
                }
                return null
            },
        },
    }
</script>
